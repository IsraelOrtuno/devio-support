<?php

use Devio\Support\Rules\HtmlMin;
use Devio\Support\Rules\HtmlMax;
use Devio\Support\Rules\JsonObject;
use Devio\Support\Rules\Rule;
use Devio\Support\Rules\UrlOrEmail;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Validator;

$trans = new Translator(new ArrayLoader, 'en');

it('validates a url or an email', function () use ($trans) {
    $v = new Validator($trans, ['item' => 'me@jobbb.com'], ['item' => new UrlOrEmail]);
    expect($v->passes())->toBe(true);

    $v = new Validator($trans, ['item' => 'http://me.com'], ['item' => new UrlOrEmail]);
    expect($v->passes())->toBe(true);

    $v = new Validator($trans, ['item' => 'foo'], ['item' => new UrlOrEmail]);
    expect($v->passes())->toBeFalse();
});

it('validates min html content length', function () use ($trans) {
    $v = new Validator($trans, ['foo' => '<p>12345678910</p>'], ['foo' => new HtmlMin(10)]);
    expect($v->passes())->toBeTrue();

    $v = new Validator($trans, ['foo' => '<p>123456789</p>'], ['foo' => new HtmlMin(10)]);
    expect($v->passes())->toBeFalse();

    $v = new Validator($trans, ['foo' => '<p data-attribute style="color: red"><div>123</div></p>'], ['foo' => new HtmlMin(10)]);
    expect($v->passes())->toBeFalse();

    $v = new Validator($trans, ['foo' => '<p>123456789</p>'], ['foo' => new HtmlMin(10)]);
    expect($v->errors()->first('foo'))->toBe('The foo field must be least 10 characters.');
});

it('validates max html content length', function () use ($trans) {
    $v = new Validator($trans, ['foo' => '<p>1234567890</p>'], ['foo' => new HtmlMax(10)]);
    expect($v->passes())->toBeTrue();

    $v = new Validator($trans, ['foo' => '<p>12345678910</p>'], ['foo' => new HtmlMax(10)]);
    expect($v->passes())->toBeFalse();

    $v = new Validator($trans, ['foo' => '<p data-attribute style="color: red"><div>123</div></p>'], ['foo' => new HtmlMax(10)]);
    expect($v->passes())->toBeTrue();

    $v = new Validator($trans, ['foo' => '<p>12345678910</p>'], ['foo' => new HtmlMax(10)]);
    expect($v->errors()->first('foo'))->toBe('The foo field must not be greater than 10 characters.');
});

it('validates an object', function () use ($trans) {
    $v = new Validator($trans, ['item' => (object)['name' => 'foo']], ['item' => new JsonObject]);
    expect($v->passes())->toBeTrue();

    $v = new Validator($trans, ['item' => ['name' => 'foo']], ['item' => new JsonObject]);
    expect($v->passes())->toBeTrue();

    $v = new Validator($trans, ['item' => ['foo', 'bar', 'baz']], ['item' => new JsonObject]);
    expect($v->passes())->toBeFalse();

    $v = new Validator($trans, ['item' => 1], ['item' => new JsonObject]);
    expect($v->passes())->toBeFalse();

    $v = new Validator($trans, ['item' => 'foo'], ['item' => new JsonObject]);
    expect($v->passes())->toBeFalse();
});

it('makes missing values optional', function () use ($trans) {
    $v = new Validator($trans, ['item' => 'foo'], Rule::makeOptional(['item' => 'required']));
    expect($v->passes())->toBeTrue();

    $v = new Validator($trans, [], Rule::makeOptional(['item' => 'required']));
    expect($v->passes())->toBeTrue();
});