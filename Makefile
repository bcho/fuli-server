.PHONY: tests

tests:
	./vendor/bin/phpunit UnitTest app/tests/*
