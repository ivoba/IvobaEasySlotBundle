EasySlotBundle
---------------
stores a simple collection of objects serialized in a file

needs write access on storeDir: ivoba_easy_slot.store.dir  

dependencies:
 assetic
 twig

installation:
 composer

configutation:
 routings
_easyslot:
    resource: "@IvobaEasySlotBundle/Resources/config/routing.yml"
    prefix:   /easyslot

 assetic whitelist
 data dir

assets:install
in prod run assetic:dump



