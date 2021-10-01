<?php


namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;


class InstalledVersions
{
    private static $installed = array(
        'root' =>
            array(
                'pretty_version' => 'dev-master',
                'version' => 'dev-master',
                'aliases' =>
                    array(),
                'reference' => 'c95a936fbce6542e294c25f01c40a31ffecf3919',
                'name' => '__root__',
            ),
        'versions' =>
            array(
                '__root__' =>
                    array(
                        'pretty_version' => 'dev-master',
                        'version' => 'dev-master',
                        'aliases' =>
                            array(),
                        'reference' => 'c95a936fbce6542e294c25f01c40a31ffecf3919',
                    ),
                'firebase/php-jwt' =>
                    array(
                        'pretty_version' => 'v5.4.0',
                        'version' => '5.4.0.0',
                        'aliases' =>
                            array(),
                        'reference' => 'd2113d9b2e0e349796e72d2a63cf9319100382d2',
                    ),
                'google/auth' =>
                    array(
                        'pretty_version' => 'v1.18.0',
                        'version' => '1.18.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '21dd478e77b0634ed9e3a68613f74ed250ca9347',
                    ),
                'google/cloud-core' =>
                    array(
                        'pretty_version' => 'v1.43.0',
                        'version' => '1.43.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '2cbd6d2d975611cd420df428344049fe3a20dbde',
                    ),
                'google/cloud-logging' =>
                    array(
                        'pretty_version' => 'v1.22.0',
                        'version' => '1.22.0.0',
                        'aliases' =>
                            array(),
                        'reference' => 'fd979881611c25fc54685d8d8d924c96409b8e99',
                    ),
                'google/common-protos' =>
                    array(
                        'pretty_version' => '1.3.1',
                        'version' => '1.3.1.0',
                        'aliases' =>
                            array(),
                        'reference' => 'c348d1545fbeac7df3c101fdc687aba35f49811f',
                    ),
                'google/gax' =>
                    array(
                        'pretty_version' => 'v1.9.1',
                        'version' => '1.9.1.0',
                        'aliases' =>
                            array(),
                        'reference' => '1cb6414a33d7af5381bb18e47c6c9bcb8cb8d5b4',
                    ),
                'google/grpc-gcp' =>
                    array(
                        'pretty_version' => 'v0.2.0',
                        'version' => '0.2.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '2465c2273e11ada1e95155aa1e209f3b8f03c314',
                    ),
                'google/protobuf' =>
                    array(
                        'pretty_version' => 'v3.18.0',
                        'version' => '3.18.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '24fed401306c943be38a1371ca2f3db2cd8137fb',
                    ),
                'grpc/grpc' =>
                    array(
                        'pretty_version' => '1.39.0',
                        'version' => '1.39.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '101485614283d1ecb6b2ad1d5b95dc82495931db',
                    ),
                'guzzlehttp/guzzle' =>
                    array(
                        'pretty_version' => '7.3.0',
                        'version' => '7.3.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '7008573787b430c1c1f650e3722d9bba59967628',
                    ),
                'guzzlehttp/promises' =>
                    array(
                        'pretty_version' => '1.4.1',
                        'version' => '1.4.1.0',
                        'aliases' =>
                            array(),
                        'reference' => '8e7d04f1f6450fef59366c399cfad4b9383aa30d',
                    ),
                'guzzlehttp/psr7' =>
                    array(
                        'pretty_version' => '2.0.0',
                        'version' => '2.0.0.0',
                        'aliases' =>
                            array(),
                        'reference' => '1dc8d9cba3897165e16d12bb13d813afb1eb3fe7',
                    ),
                'monolog/monolog' =>
                    array(
                        'pretty_version' => '2.3.4',
                        'version' => '2.3.4.0',
                        'aliases' =>
                            array(),
                        'reference' => '437e7a1c50044b92773b361af77620efb76fff59',
                    ),
                'psr/cache' =>
                    array(
                        'pretty_version' => '1.0.1',
                        'version' => '1.0.1.0',
                        'aliases' =>
                            array(),
                        'reference' => 'd11b50ad223250cf17b86e38383413f5a6764bf8',
                    ),
                'psr/http-client' =>
                    array(
                        'pretty_version' => '1.0.1',
                        'version' => '1.0.1.0',
                        'aliases' =>
                            array(),
                        'reference' => '2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
                    ),
                'psr/http-client-implementation' =>
                    array(
                        'provided' =>
                            array(
                                0 => '1.0',
                            ),
                    ),
                'psr/http-factory' =>
                    array(
                        'pretty_version' => '1.0.1',
                        'version' => '1.0.1.0',
                        'aliases' =>
                            array(),
                        'reference' => '12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
                    ),
                'psr/http-factory-implementation' =>
                    array(
                        'provided' =>
                            array(
                                0 => '1.0',
                            ),
                    ),
                'psr/http-message' =>
                    array(
                        'pretty_version' => '1.0.1',
                        'version' => '1.0.1.0',
                        'aliases' =>
                            array(),
                        'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
                    ),
                'psr/http-message-implementation' =>
                    array(
                        'provided' =>
                            array(
                                0 => '1.0',
                            ),
                    ),
                'psr/log' =>
                    array(
                        'pretty_version' => '1.1.4',
                        'version' => '1.1.4.0',
                        'aliases' =>
                            array(),
                        'reference' => 'd49695b909c3b7628b6289db5479a1c204601f11',
                    ),
                'psr/log-implementation' =>
                    array(
                        'provided' =>
                            array(
                                0 => '1.0.0 || 2.0.0 || 3.0.0',
                            ),
                    ),
                'ralouphie/getallheaders' =>
                    array(
                        'pretty_version' => '3.0.3',
                        'version' => '3.0.3.0',
                        'aliases' =>
                            array(),
                        'reference' => '120b605dfeb996808c31b6477290a714d356e822',
                    ),
                'rize/uri-template' =>
                    array(
                        'pretty_version' => '0.3.3',
                        'version' => '0.3.3.0',
                        'aliases' =>
                            array(),
                        'reference' => '6e0b97e00e0f36c652dd3c37b194ef07de669b82',
                    ),
            ),
    );
    private static $canGetVendors;
    private static $installedByVendor = array();


    public static function getInstalledPackages()
    {
        $packages = array();
        foreach (self::getInstalled() as $installed) {
            $packages[] = array_keys($installed['versions']);
        }


        if (1 === \count($packages)) {
            return $packages[0];
        }

        return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
    }


    public static function isInstalled($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (isset($installed['versions'][$packageName])) {
                return true;
            }
        }

        return false;
    }


    public static function satisfies(VersionParser $parser, $packageName, $constraint)
    {
        $constraint = $parser->parseConstraints($constraint);
        $provided = $parser->parseConstraints(self::getVersionRanges($packageName));

        return $provided->matches($constraint);
    }


    public static function getVersionRanges($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            $ranges = array();
            if (isset($installed['versions'][$packageName]['pretty_version'])) {
                $ranges[] = $installed['versions'][$packageName]['pretty_version'];
            }
            if (array_key_exists('aliases', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
            }
            if (array_key_exists('replaced', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
            }
            if (array_key_exists('provided', $installed['versions'][$packageName])) {
                $ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
            }

            return implode(' || ', $ranges);
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }


    public static function getVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['version'])) {
                return null;
            }

            return $installed['versions'][$packageName]['version'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }


    public static function getPrettyVersion($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['pretty_version'])) {
                return null;
            }

            return $installed['versions'][$packageName]['pretty_version'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }


    public static function getReference($packageName)
    {
        foreach (self::getInstalled() as $installed) {
            if (!isset($installed['versions'][$packageName])) {
                continue;
            }

            if (!isset($installed['versions'][$packageName]['reference'])) {
                return null;
            }

            return $installed['versions'][$packageName]['reference'];
        }

        throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
    }


    public static function getRootPackage()
    {
        $installed = self::getInstalled();

        return $installed[0]['root'];
    }


    public static function getRawData()
    {
        return self::$installed;
    }


    public static function reload($data)
    {
        self::$installed = $data;
        self::$installedByVendor = array();
    }


    private static function getInstalled()
    {
        if (null === self::$canGetVendors) {
            self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
        }

        $installed = array();

        if (self::$canGetVendors) {

            foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
                if (isset(self::$installedByVendor[$vendorDir])) {
                    $installed[] = self::$installedByVendor[$vendorDir];
                } elseif (is_file($vendorDir . '/composer/installed.php')) {
                    $installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir . '/composer/installed.php';
                }
            }
        }

        $installed[] = self::$installed;

        return $installed;
    }
}
