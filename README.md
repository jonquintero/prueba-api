<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## API TEST

<p>Api que hace consumo de diferentes servicios externos, usando unicamente un endpoint realizado con Laravel y Vue.js.</p>
<p>El codigo de la Api se encuentra debidamente comentado donde se muestra el funcionamiento que hace cada método en el sistema.</p>
<p>Los principales archivos son <b>Helpers/HelperSearch.php</b> que se encarga de realizar todos el proceso necesario para el consumo
de la API desde diferentes fuentes. <b>Traits/ConsumeExternalServices.php</b> Se encarga de la conexion externa hacia las diferentes
fuentes de consumo de datos, <b>Http/Controllers/SearchController.php</b> se encarga del procesamiento de la API y en el 
directorio <b>resources/js/components</b> se encuentran los componentes Vue.js usados en la interfaz grafica.
</p>

##COMO REALIZAR LA PRUEBA

<p>Antes de probar la API procedamos primero a la instalacion:</p>
<p>-Si el sistema se va a ejecutar en un entorno Linux es de gran utilidad seguir esta guia <a href="https://ubunlog.com/laravel-framework-php-ubuntu/">https://ubunlog.com/laravel-framework-php-ubuntu/</a> para configurar entorno donde se ejecute un sistema hecho con laravel.</p>
<p>-Para ejecutar sistemas usando como ejemplo Vue.js se necesitan Node.js y NPM favor siga esta guia para su instalacion <a href="https://www.hostinger.es/tutoriales/instalar-node-js-ubuntu/">https://www.hostinger.es/tutoriales/instalar-node-js-ubuntu/</a></p>
<p>- Clone el repositorio.</p>
<p>- cd jonathan-quintero.</p>
<p>-Copiar el archivo de entorno cp .env.example .env.</p>
<p>-Ejecute composer install desde la consola</p>
<p>-Ejecute el comando npm install</p>
<p>-Para compilar los archivos ejecute npm run watch</p>
<p>-Si va ejecutar de forma local use el comando php artisan serve luego puede acceder al navegador mediante esta URL http://127.0.0.1:8000 o http://localhost:8000</p>
<p>-Si usa Postman para probar la conexion API debe usar la siguiente ruta http://localhost:8000/api/search</p>


