<?php
namespace Makasim\Values;

class ObjectBuilderHook
{
    /**
     * @var string[]
     */
    private $classMap;

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @param string[] $classMap
     * @param string $fieldName
     */
    public function __construct(array $classMap, string $fieldName = 'schema')
    {
        $this->classMap = $classMap;
        $this->fieldName = $fieldName;
    }

    public function register()
    {
        register_global_hook(HooksEnum::GET_OBJECT_CLASS, function(array $values) {
            if (false == isset($values[$this->fieldName])) {
                return;
            }
            if (false == array_key_exists($values[$this->fieldName], $this->classMap)) {
                return;
            }

            return $this->classMap[$values[$this->fieldName]];
        });
    }
}