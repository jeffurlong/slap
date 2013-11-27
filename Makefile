PUB = public

build: clean css js

clean:
	rm -Rf app/assets/tmp/* $(PUB)/assets/css/* $(PUB)/assets/js/* ^.gitignore


css:
	lessc -yui-compress  app/assets/less/www.less $(PUB)/assets/css/slap.min.css

js:
	cp app/assets/js/modernizr.simple.min.js $(PUB)/assets/js/modernizr.min.js
