const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '~css': path.resolve('resources/css'),
        },
    },
    devtool: "inline-source-map",
};
