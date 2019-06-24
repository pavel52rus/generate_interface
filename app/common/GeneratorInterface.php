<?php
namespace App\common;


class GeneratorInterface
{
    private $_reflectionObj;
    private $_interfaceMethods = array();
    private $_implementsInterface;
    private $_publicMethods;

    public function __construct($className, $filePath)
    {
        $content = file_get_contents($filePath);
        $content = preg_replace("/(require|require_once|include|include_once)\s(.*?);/sm", "", $content);
        file_put_contents($filePath, $content);
        require_once $filePath;
        $this->_reflectionObj = new \ReflectionClass($className);
        $this->_implementsInterface = $this->_reflectionObj->getInterfaces();
        $this->_publicMethods = $this->_getPublicMethods();
    }

    private function _getPublicMethods()
    {
        return $this->_reflectionObj->getMethods(\ReflectionMethod::IS_PUBLIC);
    }

    private function _constructMethodsInterface()
    {
        $i = count($this->_interfaceMethods);

        foreach ($this->_publicMethods as $method) {
            if ($this->_hasMethodInInterface($method->getName())) {
                continue;
            }
            $this->_interfaceMethods[$i] = $method->isFinal() ? "final public" : "public";
            $this->_interfaceMethods[$i] .= $method->isStatic() ? " static function" : " function";
            $this->_interfaceMethods[$i] .= " {$method->getName()}(";

            $parameters = $method->getParameters();
            for ($k = 0; $k < count($parameters); $k++) {
                $this->_interfaceMethods[$i] .= $parameters[$k]->hasType() ? $parameters[$k]->getType()->getName() : "";
                $this->_interfaceMethods[$i] .= " $" . $parameters[$k]->getName();
                $this->_interfaceMethods[$i] .= $parameters[$k]->isOptional() ? " = " . $parameters[$k]->getDefaultValue() : "";
                $this->_interfaceMethods[$i] .= ($k + 1 === count($parameters)) ? "" : ",";
            }
            $this->_interfaceMethods[$i] .= ");";
            $i++;
        }
    }

    private function _hasMethodInInterface($methodName)
    {
        foreach ($this->_implementsInterface as $interface) {
            if ($interface->hasMethod($methodName)) {
                return true;
            }
        }
        return false;
    }

    public function getMethods()
    {
        $this->_constructMethodsInterface();
        return $this->_interfaceMethods;
    }


    public function getName()
    {
        $className = $this->_reflectionObj->getName();

        return "Interface{$className}";
    }

}