#!/usr/bin/env node

/*
 * Based upon the Archiver quickstart.
 * @see: https://www.archiverjs.com/docs/quickstart
 */

// Require modules.
const fs = require('fs');
const archiver = require('archiver');

const args = process.argv.slice(2);
const slug = args[0];

if (!slug) {
	console.warn('Theme slug is missing.');
	process.exit(1);
}

// Create a file to stream archive data to.
const output = fs.createWriteStream(__dirname + '/../' + slug + '.zip');
const archive = archiver('zip');

// Listen for all archive data
output.on('close', function () {
	console.log(archive.pointer() + ' total bytes.');
	console.log('Theme ZIP file created.');
});

// @see: https://nodejs.org/api/stream.html#stream_event_end
output.on('end', function () {
	console.log('Data has been drained');
});

// Catch warnings.
archive.on('warning', function (err) {
	if (err.code === 'ENOENT') {
		console.warn(err);
	} else {
		throw err;
	}
});

// Catch errors.
archive.on('error', function (err) {
	throw err;
});

archive.pipe(output);

// Append the entire contents of the theme directory to a directory with the theme slug.
archive.directory(__dirname + '/../theme/', slug);

archive.finalize();
