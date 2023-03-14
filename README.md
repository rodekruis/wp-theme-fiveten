# FiveTen

> A Wordpress theme for the [510 website](https://www.510.global/) based on [`_tw`](https://underscoretw.com/)

## Installation

-   Make sure to have a Node.js environment installed (see [`.node-version`](.node-version))
-   Run `npm install` in this folder
-   Run `npm run setup` to install the Wordpress-development environment

After this a local test-site should be running at: <http://localhost:8888/>  
Login to [Wordpress](http://localhost:8888/wp-admin/) with user: `admin` and password: `password`

## Theme Development

-   Make sure your local Wordpress-development environment is running
-   Run `npm run watch`

## Theme Deployment

-   Run `npm run bundle`
-   Upload the resulting zip-file to your site using the “Upload Theme” button on the “Add Themes” administration page

---

## Tools in use

-   Node.js / [`fnm`](https://github.com/Schniz/fnm) - To automatically handle the Node.js environment in use
-   [`wp-env`](https://www.npmjs.com/package/@wordpress/env) - To manage the local Wordpress environment
-   [ESLint](https://eslint.org/) - To ensure consistent code practices
-   [Prettier](https://prettier.io/) - To ensure consistent code style
-   [`esbuild`](https://esbuild.github.io/) - To bundle/combine/minify/process JavaScript for use in the browser
-   [PostCSS](https://postcss.org/) - To bundle/combine/minify/process CSS for use in the browser

### Recommendations

-   [Workspace recommendations for VS Code](.vscode/extensions.json)
    When you use [VS Code](https://code.visualstudio.com/) and go to: "_Extensions_" and use the filter: "_Recommended_";
    A list should be shown and each extension can be installed individually.
