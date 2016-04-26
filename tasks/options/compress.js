module.exports = {
	main: {
		options: {
			mode: 'zip',
			archive: './release/additive.<%= pkg.version %>.zip'
		},
		expand: true,
		cwd: 'release/<%= pkg.version %>/',
		src: ['**/*'],
		dest: 'additive/'
	}
};