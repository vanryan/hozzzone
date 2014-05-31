var myOption = {
    sass_file: [{
        expand: true,
        cwd: 'src/scss/',
        src: ['main.scss'],
        dest: 'public/css/',
        ext: '.css' 
    }],
    uglify_file: [{ 
        expand: true,
        cwd: 'public/js/concat/',
        src: ['**/*.js'],
        dest: 'public/js/',
        ext: '.min.js'
    }],
    banner: '/*!\n' +
            ' * <%= pkg.name %>\n' +
            ' * @version <%= pkg.version %>\n' +
            ' * @time <%= grunt.template.today("yyyy-mm-dd") %> ' + new Date().getHours() + ':' + new Date().getMinutes() + '\n' +
            ' */\n'
};


module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // to include static html snippets
        includes: {
            dist: {
                cwd: 'templates/src/',
                src: ['*.html'],
                dest: 'templates/',
                options: {
                    flatten: true,
                    includePath: 'templates/include/'
                }
            }
        },
        sass: {
            options: {
                banner: myOption.banner
            },
            dev: {
                options: {
                    style: 'expanded',
                    sourcemap: true
                },
                files: myOption.sass_file 
            },
            dist: {
                options: {
                    style: 'compressed'
                },
                files: myOption.sass_file 
            } 
        },
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                files: [{
                    src: ['src/js/model/user.js', 
                        'src/js/router/router.js', 
                        'src/js/view/View.js', 
                        'src/js/view/viewFactory.js', 
                        'src/js/view/resourceFactory.js',
                        'src/js/view/viewer.js', 
                        'src/js/view/Button.js', 
                        'src/js/view/rightBar.js', 
                        'src/js/view/nav.js',
                        'src/js/view/album.js',
                        'src/js/app.js'], 
                    dest: 'public/js/concat/bundle.js'
                }] 
            }
        },
        uglify: {
            // task level
            options: {
                banner: myOption.banner
            },
            dev: {
                // target level
                options: {
                    sourceMap: true,
                    sourceMapRoot: 'public/js/'
                },
                files: myOption.uglify_file 
            },
            dist: {
                // target level
                options: {
                    compress: {
                        drop_console: true // discard calls to console.* functions
                    }
                },
                files: myOption.uglify_file
            },
        },
        jshint: {
            options: {
                expr: true,
                curly: true,
                browser: true,
                globals: {
                    jQuery: true
                }
            },
            all: {
                src: ['Gruntfile.js', 'src/**/*.js']
            }
        },
        watch: {
            options: {
                livereload: true,
                interrupt: true
            },
            html: {
                files: ['templates/src/**/*.html', 'templates/include/**/*.html'],
                tasks: ['includes']
            },
            css: {
                files: ['src/scss/**/*.scss'],
                tasks: ['sass:dev']
            },
            js: {
                files: ['src/js/**/*.js', 'Gruntfile.js'],
                tasks: ['jshint', 'concat:dist', 'uglify:dev'],
                options: {
                    spawn: false
                }
            }
        }
    }); 


    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-includes');
//    grunt.loadNpmTasks('grunt-contrib-qunit');

    grunt.event.on('watch', function(action, filepath) {
        grunt.config('jshint.all.src', filepath);
    });

    grunt.registerTask('default', ['includes', 'sass:dev', 'jshint', 'concat:dist', 'uglify:dev']);
    grunt.registerTask('dist', ['includes', 'sass:dist', 'concat', 'uglify:dist']);

};
