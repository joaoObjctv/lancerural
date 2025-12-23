const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
    mode: 'none',
    entry: {},
    output: {
        path: path.resolve(__dirname, 'dist/js'),
    },
    plugins: [
        new CleanWebpackPlugin(),
    ],
};