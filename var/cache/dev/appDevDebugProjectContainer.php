<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerA86otg8\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerA86otg8/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerA86otg8.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerA86otg8\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerA86otg8\appDevDebugProjectContainer(array(
    'container.build_hash' => 'A86otg8',
    'container.build_id' => '127376bf',
    'container.build_time' => 1540822090,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerA86otg8');
