/* eslint-env node */
// See: https://eslint.org/docs/latest/use/configure/
const restrictedGlobals = require('confusing-browser-globals');

module.exports = {
	root: true,
	ignorePatterns: ['*.min.js'],
	overrides: [
		{
			files: ['*.js'],
			parserOptions: {
				ecmaVersion: 'latest',
				sourceType: 'module',
			},
			plugins: [
				'jsdoc',
				'write-good-comments',
				'import',
				'simple-import-sort',
				'compat',
				'no-unsanitized',
			],
			extends: [
				'eslint:recommended',
				'plugin:jsdoc/recommended',
				'plugin:eslint-comments/recommended',
				'plugin:import/recommended',
				'plugin:compat/recommended',
				'plugin:no-unsanitized/DOM',
				'prettier',
			],
			rules: {
				'eslint-comments/no-unused-disable': 'error',
				'eslint-comments/require-description': [
					'error',
					{ ignore: ['eslint-env'] },
				],
				'write-good-comments/write-good-comments': 'warn',
				'simple-import-sort/imports': 'error',
				'simple-import-sort/exports': 'error',
			},
		},
		{
			files: ['js/*.js'],
			env: {
				browser: true,
			},
			parserOptions: {
				ecmaVersion: '2020',
			},
			rules: {
				'no-restricted-globals': ['error'].concat(restrictedGlobals),
			},
		},
		{
			files: ['node_scripts/*.js'],
			parserOptions: {
				ecmaVersion: 2018,
			},
			env: {
				node: true,
			},
			rules: {
				'no-console': 'off',
			},
		},
		{
			files: ['*.json', '*.jsonc', '*.json5'],
			parser: 'jsonc-eslint-parser',
			extends: [
				'plugin:jsonc/recommended-with-jsonc',
				'plugin:json-schema-validator/recommended',
			],
		},
		{
			files: ['*.php'],
			parser: '@html-eslint/parser',
			plugins: ['php-markup', '@html-eslint'],
			rules: {
				'@html-eslint/no-abstract-roles': 'error',
				'@html-eslint/no-accesskey-attrs': 'error',
				'@html-eslint/no-duplicate-attrs': 'error',
				'@html-eslint/no-duplicate-id': 'error',
				'@html-eslint/no-non-scalable-viewport': 'error',
				'@html-eslint/no-obsolete-tags': 'error',
				'@html-eslint/no-positive-tabindex': 'error',
				'@html-eslint/quotes': 'error',
				'@html-eslint/require-button-type': 'error',
				'@html-eslint/require-li-container': 'error',
			},
		},
	],
};
