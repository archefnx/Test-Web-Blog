<?php

namespace Test\DevCoder;

use DevCoder\DotEnv;
<<<<<<< HEAD
=======
use DevCoder\Option;
use DevCoder\Processor\BooleanProcessor;
use DevCoder\Processor\QuotedProcessor;
use PHPUnit\Framework\Assert;
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
use PHPUnit\Framework\TestCase;

class DotenvTest extends TestCase
{
    private function env(string $file)
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'env' . DIRECTORY_SEPARATOR . $file;
    }

    /**
     * @runInSeparateProcess
     */
    public function testLoad() {
        (new DotEnv($this->env('.env.default')))->load();
        $this->assertEquals('dev', getenv('APP_ENV'));
        $this->assertEquals('mysql:host=localhost;dbname=test;', getenv('DATABASE_DNS'));
        $this->assertEquals('root', getenv('DATABASE_USER'));
        $this->assertEquals('password', getenv('DATABASE_PASSWORD'));
        $this->assertFalse(getenv('GOOGLE_API'));
        $this->assertFalse(getenv('GOOGLE_MANAGER_KEY'));
<<<<<<< HEAD
=======
        $this->assertEquals(true, getenv('BOOLEAN_LITERAL'));
        $this->assertEquals('true', getenv('BOOLEAN_QUOTED'));
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

        $this->assertEquals('dev', $_ENV['APP_ENV']);
        $this->assertEquals('mysql:host=localhost;dbname=test;', $_ENV['DATABASE_DNS']);
        $this->assertEquals('root', $_ENV['DATABASE_USER']);
        $this->assertEquals('password', $_ENV['DATABASE_PASSWORD']);
        $this->assertFalse(array_key_exists('GOOGLE_API', $_ENV));
        $this->assertFalse(array_key_exists('GOOGLE_MANAGER_KEY', $_ENV));
<<<<<<< HEAD
=======
        $this->assertEquals(true, $_ENV['BOOLEAN_LITERAL']);
        $this->assertEquals('true', $_ENV['BOOLEAN_QUOTED']);
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

        $this->assertEquals('dev', $_SERVER['APP_ENV']);
        $this->assertEquals('mysql:host=localhost;dbname=test;', $_SERVER['DATABASE_DNS']);
        $this->assertEquals('root', $_SERVER['DATABASE_USER']);
        $this->assertEquals('password', $_SERVER['DATABASE_PASSWORD']);
        $this->assertFalse(array_key_exists('GOOGLE_API', $_SERVER));
        $this->assertFalse(array_key_exists('GOOGLE_MANAGER_KEY', $_SERVER));
<<<<<<< HEAD
=======
        $this->assertEquals(true, $_SERVER['BOOLEAN_LITERAL']);
        $this->assertEquals('true', $_SERVER['BOOLEAN_QUOTED']);
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
    }

    public function testFileNotExist() {
        $this->expectException(\InvalidArgumentException::class);
        (new DotEnv($this->env('.env.not-exists')))->load();
    }

<<<<<<< HEAD
=======
    public function testUncompatibleProcessors() {
        $this->assertProcessors(
            [],
            []
        );

        $this->assertProcessors(
            null,
            [BooleanProcessor::class, QuotedProcessor::class]
        );

        $this->assertProcessors(
            [null],
            []
        );

        $this->assertProcessors(
            [new \stdClass()],
            []
        );

        $this->assertProcessors(
            [QuotedProcessor::class, null],
            [QuotedProcessor::class]
        );
    }

    private function assertProcessors(array $processorsToUse = null, array $expectedProcessors = [])
    {
        $dotEnv = new DotEnv($this->env('.env.default'), $processorsToUse);
        $dotEnv->load();

        $this->assertEquals(
            $expectedProcessors,
            $this->getProtectedProperty($dotEnv, 'processors')
        );
    }

    private function getProtectedProperty(object $object, string $property) {
        $reflection = new \ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($object);
    }

>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
    /**
     * @runInSeparateProcess
     */
    public function testProcessBoolean()
    {
        (new DotEnv($this->env('.env.boolean'), [
<<<<<<< HEAD
            DotEnv::PROCESS_BOOLEANS => true
=======
            BooleanProcessor::class
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        ]))->load();

        $this->assertEquals(false, $_ENV['FALSE1']);
        $this->assertEquals(false, $_ENV['FALSE2']);
        $this->assertEquals(false, $_ENV['FALSE3']);
<<<<<<< HEAD
        $this->assertEquals("'false'", $_ENV['FALSE4']);
=======
        $this->assertEquals("'false'", $_ENV['FALSE4']); // Since we don't have the QuotedProcessor::class this will be the result
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        $this->assertEquals('0', $_ENV['FALSE5']);

        $this->assertEquals(true, $_ENV['TRUE1']);
        $this->assertEquals(true, $_ENV['TRUE2']);
        $this->assertEquals(true, $_ENV['TRUE3']);
<<<<<<< HEAD
        $this->assertEquals("'true'", $_ENV['TRUE4']);
=======
        $this->assertEquals("'true'", $_ENV['TRUE4']); // Since we don't have the QuotedProcessor::class this will be the result
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
        $this->assertEquals('1', $_ENV['TRUE5']);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDontProcessBoolean()
    {
<<<<<<< HEAD
        (new DotEnv($this->env('.env.boolean'), [
            DotEnv::PROCESS_BOOLEANS => false
        ]))->load();
=======
        (new DotEnv($this->env('.env.boolean'), []))->load();
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

        $this->assertEquals('false', $_ENV['FALSE1']);

        $this->assertEquals('true', $_ENV['TRUE1']);
    }
<<<<<<< HEAD
=======

    /**
     * @runInSeparateProcess
     */
    public function testProcessQuotes()
    {
        (new DotEnv($this->env('.env.quotes'), [
            QuotedProcessor::class
        ]))->load();

        $this->assertEquals('q1', $_ENV['QUOTED1']);
        $this->assertEquals('q2', $_ENV['QUOTED2']);
        $this->assertEquals('"q3"', $_ENV['QUOTED3']);
        $this->assertEquals('This is a "sample" value', $_ENV['QUOTED4']);
        $this->assertEquals('\"This is a "sample" value\"', $_ENV['QUOTED5']);
        $this->assertEquals('"q6', $_ENV['QUOTED6']);
        $this->assertEquals('q7"', $_ENV['QUOTED7']);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDontProcessQuotes()
    {
        (new DotEnv($this->env('.env.quotes'), []))->load();

        $this->assertEquals('"q1"', $_ENV['QUOTED1']);
        $this->assertEquals('\'q2\'', $_ENV['QUOTED2']);
        $this->assertEquals('""q3""', $_ENV['QUOTED3']);
        $this->assertEquals('"This is a "sample" value"', $_ENV['QUOTED4']);
        $this->assertEquals('\"This is a "sample" value\"', $_ENV['QUOTED5']);
        $this->assertEquals('"q6', $_ENV['QUOTED6']);
        $this->assertEquals('q7"', $_ENV['QUOTED7']);
    }
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57
}
