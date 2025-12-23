
const path = require('path');
const asbolutePath = path.resolve(__dirname, 'dist/js');

const generalConfig = {
    entry: ['./assets/js/general.js'],
    output: {
        filename: 'general.min.js',
        path: asbolutePath,
    },
};

const homeConfig = {
    entry: ['./assets/js/home.js'],
    output: {
        filename: 'home.min.js',
        path: asbolutePath,
    },
};


module.exports = [
    homeConfig, generalConfig
]