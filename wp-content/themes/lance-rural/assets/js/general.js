jQuery(document).ready(function($){
    $(this).on('click', 'a[href="#"]', function(e) {
        e.preventDefault();
    });

    $(this).on('click', '.actShowMenu', function() {
        $('.actShowMenu, .wrapMenu').toggleClass('active');
    });

    function parseDMYHisToDate(str) {
        // espera "26-09-2025 18:15:00"
        const [datePart, timePart] = str.split(' ');        // ["26-09-2025", "18:15:00"]
        const [day, month, year] = datePart.split('-').map(Number);
        const [hours, minutes, seconds] = timePart.split(':').map(Number);

        // mês no JS começa do zero → janeiro = 0
        return new Date(year, month - 1, day, hours, minutes, seconds || 0);
    }

    $('#load-more').on('click', function() {
        let button = $(this);
        let page = parseInt(button.attr('data-page')) + 1;

        $.ajax({
            url: meuAjax.ajax_url,
            type: "POST",
            data: {
                action: "get_news_ajax",
                page: page,
            },
            beforeSend: function() {
                button.text('Carregando...');
            },
            success: function(res) {
                console.log(res.data.news);

                if (res.data.news.length > 0) {
                    res.data.news.forEach(function(post) {
                        // Formatar datas no JS
                        $('#lista-news').append(`                            
                            <div class="cardNoticias">
                                <a href="${post.link}">
                                    <img fetchpriority="high" decoding="async" src="${post.thumbnail}" alt="Imagem de destaque do post: ${post.title}" />
                                </a>

                                <div class="cardNoticias__info">
                                    <div class="d-flex">
                                        <a href="#">${post.categNews}</a>
                                        <p>${post.publishDate}</p>
                                    </div>

                                    <h2>${post.title}</h2>
                                    <p>${post.excerpt}</p>
                                </div>
                            </div>                            
                        `);
                    }); 

                    button.attr('data-page', page).text('Carregar mais');

                    if (page >= res.max_num_pages) {
                        button.remove(); // remove botão se chegou no fim
                    }
                } else {
                    button.remove(); // nada mais pra carregar
                }
            }
        });
    });
});




