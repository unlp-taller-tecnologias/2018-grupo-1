<?php

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolderc5b4a = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializera50a2 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesc7b0f = [
        
    ];

    public function getConnection()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getConnection', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getMetadataFactory', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getExpressionBuilder', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'beginTransaction', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->beginTransaction();
    }

    public function getCache()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getCache', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getCache();
    }

    public function transactional($func)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'transactional', array('func' => $func), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->transactional($func);
    }

    public function commit()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'commit', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->commit();
    }

    public function rollback()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'rollback', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getClassMetadata', array('className' => $className), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'createQuery', array('dql' => $dql), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'createNamedQuery', array('name' => $name), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'createQueryBuilder', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'flush', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->flush($entity);
    }

    public function find($entityName, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'find', array('entityName' => $entityName, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->find($entityName, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'clear', array('entityName' => $entityName), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->clear($entityName);
    }

    public function close()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'close', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->close();
    }

    public function persist($entity)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'persist', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'remove', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'refresh', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'detach', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'merge', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getRepository', array('entityName' => $entityName), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'contains', array('entity' => $entity), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getEventManager', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getConfiguration', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'isOpen', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getUnitOfWork', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getProxyFactory', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'initializeObject', array('obj' => $obj), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'getFilters', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'isFiltersStateClean', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'hasFilters', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return $this->valueHolderc5b4a->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? $reflection = new \ReflectionClass(__CLASS__);
        $instance = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializera50a2 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderc5b4a) {
            $reflection = $reflection ?: new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderc5b4a = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderc5b4a->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, '__get', ['name' => $name], $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        if (isset(self::$publicPropertiesc7b0f[$name])) {
            return $this->valueHolderc5b4a->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderc5b4a;

            $backtrace = debug_backtrace(false);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    get_parent_class($this),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
            return;
        }

        $targetObject = $this->valueHolderc5b4a;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, '__set', array('name' => $name, 'value' => $value), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderc5b4a;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolderc5b4a;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, '__isset', array('name' => $name), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderc5b4a;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderc5b4a;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, '__unset', array('name' => $name), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderc5b4a;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderc5b4a;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, '__clone', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        $this->valueHolderc5b4a = clone $this->valueHolderc5b4a;
    }

    public function __sleep()
    {
        $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, '__sleep', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;

        return array('valueHolderc5b4a');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializera50a2 = $initializer;
    }

    public function getProxyInitializer()
    {
        return $this->initializera50a2;
    }

    public function initializeProxy() : bool
    {
        return $this->initializera50a2 && ($this->initializera50a2->__invoke($valueHolderc5b4a, $this, 'initializeProxy', array(), $this->initializera50a2) || 1) && $this->valueHolderc5b4a = $valueHolderc5b4a;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderc5b4a;
    }

    public function getWrappedValueHolderValue() : ?object
    {
        return $this->valueHolderc5b4a;
    }


}
