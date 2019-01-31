/**
 * Webpack Config
 */

// Webpack Dependencies
const webpack = require('webpack');
const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');

// Webpack Plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CleanPlugin = require('clean-webpack-plugin');
const LivereloadPlugin = require('webpack-livereload-plugin');
const StatsPlugin = require('webpack-stats-plugin').StatsWriterPlugin;
const StylelintPlugin = require('stylelint-webpack-plugin');
const Autoprefixer = require('autoprefixer');

// Config Variables
const themeDir = path.join(__dirname, '../../').match(/([^\/]*)\/*$/)[1];

// Custom Helper Functions
const AssetVersions = require('./asset-versions.js');

// Build Config
module.exports = (env) => {
  // Set up minimizer options for environment
  const minimizer = [];

  if (env.build) {
    minimizer.push(
      new TerserPlugin({
        cache: true,
        parallel: true,
        sourceMap: true,
      }),
      new OptimizeCssAssetsPlugin({})
    );
  }

  // Set up plugins for environment
  const plugins = [
    new StylelintPlugin({
      configFile: path.join(__dirname, 'stylelint.config.js'),
    }),
  ];

  if (env.build) {
    plugins.push(
      new CleanPlugin(['assets/dist'], {
        root: path.join(__dirname, '../../'),
      })
    );
  }

  if (env.watch) {
    plugins.push(
      new LivereloadPlugin({
        appendScriptTag: true,
        hostname: 'localhost',
      })
    );
  }

  if (env.start) {
    plugins.push(
      new webpack.HotModuleReplacementPlugin()
    );
  }

  if (! env.start) {
    plugins.push(
      new MiniCssExtractPlugin({
        filename: env.build
          ? '[name].[hash:6].css'
          : '[name].css',
      }),
      new StatsPlugin({
        transform: (stats) => AssetVersions(stats),
        filename: '../../inc/asset-versions.php',
      })
    );
  }

  // Set up SCSS options for environment
  const scssOptions = [
    'css-loader',
    {
      loader: 'postcss-loader',
      options: {
        autoprefixer: {
          browsers: ['last 3 versions'],
        },
        plugins: () => [
          Autoprefixer(),
        ],
      },
    },
    'sass-loader',
  ];

  if (! env.start) {
    scssOptions.unshift(
      MiniCssExtractPlugin.loader
    );
  }

  return {
    entry: {
      archive: './assets/src/archive/index.js',
      editor: './assets/src/editor/index.js',
      page: './assets/src/page/index.js',
      post: './assets/src/post/index.js',
      site: './assets/src/site/index.js',
      user: './assets/src/user/index.js',
    },
    output: {
      path: path.join(__dirname, '../dist/'),
      publicPath: env.start
        ? 'https://localhost:8080/dist/'
        : `wp-content/themes/${themeDir}/assets/dist/`,
      filename: env.build
        ? '[name].[hash:6].js'
        : '[name].js',
    },
    module: {
      rules: [
        {
          enforce: 'pre',
          test: /\.js$/,
          exclude: /node_modules/,
          loader: 'eslint-loader',
          options: {
            configFile: 'assets/.eslintrc',
          },
        },
        {
          test: /\.js$/,
          exclude: /node_modules/,
          loader: 'babel-loader',
        },
        {
          test: /\.scss$/,
          use: scssOptions,
        },
        {
          test: /\.css$/,
          use: [
            'style-loader',
            'css-loader',
          ],
        },
        {
          test: /\.png(\?v=\d+\.\d+\.\d+)?$/,
          use: 'url-loader',
        },
        {
          test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
          use: {
            loader: 'url-loader',
            options: {
              limit: 10000,
              mimetype: 'image/svg+xml',
            },
          },
        },
      ],
    },
    optimization: {
      minimizer,
    },
    plugins,
    devtool: 'source-map',
    externals: {
      jquery: 'jQuery',
    },
    devServer: {
      hot: true,
      quiet: false,
      noInfo: false,
      contentBase: './dist',
      https: true,
      disableHostCheck: true,
      headers: { 'Access-Control-Allow-Origin': '*' },
      stats: { colors: true },
    },
  };
};
