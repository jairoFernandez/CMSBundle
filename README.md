## CMS BUNDLE
Is a very simple cms

Install!
```sh
git clone https://github.com/jairoFg12/CMSBundle.git
```
Register the bundle
```sh
#app/AppKernel.php
...
new Tucompu\CmsBundle\CmsBundle()
...
```

Add the routing

```sh
    cms:
        resource: "@CmsBundle/Controller/"
        type:     annotation
```

Update the database
```sh
app/console doctrine:schema:update --force
```