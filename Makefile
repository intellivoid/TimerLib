clean:
	rm -rf build

build:
	mkdir build
	ppm --no-intro --compile="src/TimerLib" --directory="build"

update:
	ppm --generate-package="src/TimerLib"

install:
	ppm --no-intro --no-prompt --fix-conflict --install="build/net.intellivoid.timerlib.ppm"

install_fast:
	ppm --no-intro --no-prompt --fix-conflict --skip-dependencies --install="build/net.intellivoid.timerlib.ppm"