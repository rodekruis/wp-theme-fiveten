/* eslint-env node */
// See: https://github.com/postcss/postcss-cli#config

const postcssPresetEnv = require('postcss-preset-env');

module.exports = {
	plugins: [
		require('postcss-import'),
		postcssPresetEnv({
			autoprefixer: { grid: true },
		}),
	],
};
