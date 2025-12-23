<?php 
/*
	Template Name: Agenda
*/
    $days = [];
    $today = new DateTime();

    for ($i = 0; $i < 7; $i++) {
        $date = clone $today;
        $date->modify("+$i days");

        $days[] = [
            'date'       => $date->format('Y-m-d'),
            'day_number' => $date->format('d'),
            'day_label'  => wp_date('D', $date->getTimestamp()),
            'is_today'   => $i === 0
        ];
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $resultado = get_leiloes($paged, 6);

    // if (!$resultado["total"] > 0) return;

    $firstLeilao = $resultado['leiloes'][0];
    $leiloes = array_slice($resultado['leiloes'], 1);
    

get_header(); ?>

<?php get_template_part( 'components/content', 'slider-auction' ); ?>

<div class="page-agenda">
    <section class="schedulePage">
        <div class="container">
            <h2 class="title">Agenda de Leilões</h2>
            
            <div class="scheduleFilter">
                <a href="#" class="btn" id="agenda-hoje"></a>
                
                <div class="d-flex">
                    <button class="btn cal-prev">
                        <span></span>
                    </button>

                    <ul class="scheduleFilter__list"></ul>

                    <button class="btn cal-next">
                        <span></span>
                    </button>
                </div>
            </div>

            <div class="scheduleAuction">
                <div class="d-flex-column"  id="lista-leiloes">
                   
                </div>
            </div>
        </div>
    </section>
    
    <?php get_template_part( 'components/content', 'banner-bottom' ); ?>
</div>

<script>
    document.querySelectorAll('.agenda-day').forEach(day => {
        day.addEventListener('click', () => {
            document.querySelectorAll('.agenda-day').forEach(d => d.classList.remove('active'));
            day.classList.add('active');
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const lista = document.querySelector('.scheduleFilter__list');
        const btnPrev = document.querySelector('.cal-prev');
        const btnNext = document.querySelector('.cal-next');

        const diasVisiveis = 7;
        let dataBase = new Date();

        const diasSemana = ['DOM', 'SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB'];

        function formatarData(data) {
            return data.toISOString().split('T')[0];
        }

        function renderizar() {
            lista.innerHTML = '';

            for (let i = 1; i < diasVisiveis; i++) {
                const data = new Date(dataBase);
                data.setDate(dataBase.getDate() + i);

                const li = document.createElement('li');
                li.dataset.date = formatarData(data);

                li.innerHTML = `
                    ${String(data.getDate()).padStart(2, '0')}
                    ${diasSemana[data.getDay()]}
                `;

                li.addEventListener('click', () => {
                    document.querySelectorAll('.scheduleFilter__list li')
                        .forEach(el => el.classList.remove('ativo'));

                    li.classList.add('ativo');
                    carregarLeiloes(li.dataset.date);
                });

                lista.appendChild(li);
            }
        }

        const btnHoje = document.getElementById('agenda-hoje');
        const hoje = new Date();
        hoje.setHours(0, 0, 0, 0);

        btnHoje.dataset.date = formatarData(hoje);
        btnHoje.innerHTML = `
            <img src="<?= get_template_directory_uri() . '/assets/img/icones/calendario.png'; ?>" alt="">
            ${String(hoje.getDate()).padStart(2, '0')}
            HOJE - ${diasSemana[hoje.getDay()]}
        `;

        btnHoje.addEventListener('click', (e) => {
            e.preventDefault();

            document.querySelectorAll('.scheduleFilter__list li')
                .forEach(el => el.classList.remove('ativo'));
            carregarLeiloes(btnHoje.dataset.date);
        });

        btnNext.addEventListener('click', () => {
            dataBase.setDate(dataBase.getDate() + 1);
            renderizar();
        });

        btnPrev.addEventListener('click', () => {
            dataBase.setDate(dataBase.getDate() - 1);
            renderizar();
        });

        renderizar();
        carregarLeiloes(formatarData(hoje));
    });


    function carregarLeiloes(data) {
        fetch( `/wp-admin/admin-ajax.php?action=get_leiloes_by_date&date=${data}` )
        .then(response => response.text())
        .then(html => { document.getElementById('lista-leiloes').innerHTML = html; });
    }
</script>

<?php get_footer(); ?>