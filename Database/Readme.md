# Database Migration Files

###What is the migration 

our migration file runs on the laravel eloquent model as a stand alone package, All Migration files must be placed in the migrations folders Database/Migrations and must be called by the install()  method

### Adding Migration files


This folders contents is designed to install and set up the database accordingly to the sites specification, 

this includes Artcles, Events, Charters, image gallery and images Storage referencece, Resoruces and user profile and settings.

in order to install these simply call the loader file located in : App\Libraries\MigrationManager\Loader.php this can called like so.

```
<?php
$loader = new Loader();
$loader->install();
?>
```

To Drop your Databases simply add 

```
<?php
$loader = new Loader();
$loader->drop();
?>
```

I have also intergrated a way to list the migration files by name and will require a foreach loop like so 
```
<?php
foreach($loader->ReadMigrations() as $file)
{
//the steps below are options one will hid file extension the other convert to lower case
$name = $loader->RemoveExtentions($file,".");
$table = $loader->lower($name);
//Your code to call file goes here
echo "$name";
}
?>
```

You can also pull the migration file contents into your own website by entering the following 

```$xslt
$loader = new Loader();
$loader->GetFiles($file)
```

this snippet relies on the migration folder and the file name do not use lower case or Remove extions simply refer the filename

this snippet also supports base64 encode/ decode this was implemented for  opening the file over a url