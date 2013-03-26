EasySlotBundle
---------------
jqueryUI driven Accordion CRUD UI for simple form based objects,  
stores a simple collection of objects serialized in a file


###configuration:  
needs write access on storeDir  
path can be configured in parameter: ivoba_easy_slot.store.dir 

import routing in your routing file:

    _easyslot:
       resource: "@IvobaEasySlotBundle/Resources/config/routing.yml"
       prefix:   /easyslot

add bundle to your assetic whitelist in config.yml

     bundles: [ IvobaEasySlotBundle ]

assets:install  
in prod run assetic:dump

