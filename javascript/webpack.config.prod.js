import webpack from 'webpack';
import path from 'path';
import ExtractTextPlugin from 'extract-text-webpack-plugin';

const GLOBALS = {
    'process.env.NODE_ENV': JSON.stringify('production')
};

/* eslint-disable no-console */
console.log("Inside webpack.config.prod.js");
/* eslint-enable no-console */

export default {
    devtool: 'source-map',
    entry: {
        generalsettings: './javascript/src/index'
    },
    target: 'web',
    output: {
        path:  './settings/scripts/',
        filename: '[name].js'
    },

    plugins: [
        new webpack.optimize.OccurrenceOrderPlugin(),
        new webpack.DefinePlugin(GLOBALS),
        new ExtractTextPlugin('mailgun-for-wp.css'),
        new webpack.optimize.UglifyJsPlugin()
    ],
    module: {
        loaders: [
            {test: /\.js$/, include: path.join(__dirname, 'src'), loaders: ['babel-loader']},
            {test: /(\.css)$/, loader: ExtractTextPlugin.extract("css?sourceMap")},
            {test: /\.less$/, loader: "style-loader!css-loader!less-loader"},
            {test: /\.(jpe?g|png|gif|svg)$/i, loaders: ['file?hash=sha512&digest=hex&name=[hash].[ext]','image-webpack?bypassOnDebug&optimizationLevel=7&interlaced=false']},
            {test: /\.eot(\?v=\d+\.\d+\.\d+)?$/, loader: "file"},
            {test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/, loader: "url-loader?limit=10000&minetype=application/font-woff" },
            {test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/, loader: "url?limit=10000&mimetype=application/octet-stream"},
            {test: /\.svg(\?v=\d+\.\d+\.\d+)?$/, loader: "url?limit=10000&mimetype=image/svg+xml"}
        ]
    }
};
