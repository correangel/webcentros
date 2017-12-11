<?php
require_once("../bootstrap.php");
require_once("../config.php");

$pagina['titulo'] = 'Aviso legal';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Términos y condiciones y política de cookies del sitio";
$pagina['meta']['meta_type'] = "website";
$pagina['meta']['meta_locale'] = "es_ES";

include("../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-8">
            
                    <p>Por favor, lea detenidamente las condiciones legales de uso de esta web.</p>
                    
                    <h4>1.- Introducción</h4>
                    <p>El <?php echo $config['centro_denominacion']; ?> (centro código <?php echo $config['centro_codigo']; ?>), con domicilio social en <?php echo $config['centro_direccion']; ?>, <?php echo $config['centro_localidad']; ?>, <?php echo $config['centro_codpostal']; ?>, <?php echo $config['centro_provincia']; ?>, es la entidad titular del sitio Web.
                    
                    </p><p>La presente Web tiene por objeto facilitar el conocimiento por el público en general del <?php echo $config['centro_denominacion']; ?>, de las actividades que realiza y de los servicios que presta.</p>
                    
                    <h4>2.- Disponibilidad</h4>
                    
                    <ol>
                        <li>El <?php echo $config['centro_denominacion']; ?> pone a disposición de los usuarios de Internet la Web (<?php echo WEBCENTROS_DOMINIO; ?>).</li>
                        <li>El acceso y/o uso del Web del <?php echo $config['centro_denominacion']; ?> es totalmente voluntario y atribuye a quien lo realiza la condición de usuario. Todo usuario acepta, desde el mismo momento en el que accede, sin ningún tipo de reserva, el contenido de las presentes "Condiciones Generales" así como, en su caso, las "Condiciones Particulares" que puedan complementarlas, sustituirlas o modificarlas en algún sentido, en relación con los servicios y contenidos de la Web. En consecuencia, el usuario deberá leer detenidamente unas y otras antes del acceso y de la utilización de cualquier servicio de la Web bajo su entera responsabilidad.</li>
                    </ol>
                    
                    <h4>3.- Objeto y modificación de condiciones</h4>
                    
                    <ol>
                        <li>El <?php echo $config['centro_denominacion']; ?> pone a disposición de los usuarios la posibilidad de acceder a los contenidos y servicios de la Web siempre que lo hagan de acuerdo con lo previsto en las presentes Condiciones Generales.</li>
                        <li>En cualquier caso, el <?php echo $config['centro_denominacion']; ?> se reserva el derecho a, en cualquier momento y sin necesidad de previo aviso, modificar o eliminar el contenido, estructura, diseño, servicios y condiciones de acceso y/o uso de este sitio, siempre que lo estime oportuno.</li>
                    </ol>
                    
                    <h4>4.- Responsabilidad del usuario</h4>
                        
                    <ol>
                        <li>El hiperenlace desde otro portal o página Web se permite exclusivamente en las condiciones aquí previstas.</li>
                        <li>Los hiperenlaces sólo podrán establecerse con la home-page del Portal y nunca con páginas distintas a la primera página del mismo, salvo autorización expresa.</li>
                        <li>En ningún caso se podrá dar a entender que el <?php echo $config['centro_denominacion']; ?> autoriza el hiperenlace o que ha supervisado o asumido de cualquier forma los servicios o contenidos ofrecidos por la web desde la que se produce el hiperenlace.</li>
                        <li>No se podrán realizar manifestaciones o referencias falsas, incorrectas o inexactas sobre las páginas y servicios de esta Web.</li>
                        <li>Se prohíbe explícitamente la creación de cualquier tipo de browser o border environment sobre las páginas del <?php echo $config['centro_denominacion']; ?>.</li>
                        <li>No se podrán incluir contenidos contrarios a los derechos de terceros, ni contrarios a la moral y las buenas costumbres aceptadas, ni contenidos o informaciones ilícitas, en la página web desde la que se establezca el hiperenlace.</li>
                        <li>La existencia de un hiperenlace entre una página web y <?php echo WEBCENTROS_DOMINIO; ?> no implica la existencia de relaciones entre el <?php echo $config['centro_denominacion']; ?> y el propietario de esa página, ni la aceptación y aprobación de sus contenidos y servicios.</li>
                        <li>El usuario será el único responsable por el uso de este sitio y por el cumplimiento de estas condiciones generales en su totalidad. En consecuencia, el usuario se obliga a mantener en secreto, con el carácter de información confidencial y reservada, cuando las tuviera, sus claves de acceso, contraseñas o datos similares asignados para acceder a cualquier servicio. Será responsable de cualesquiera daños y perjuicios de toda naturaleza derivados del mal uso realizado por sí o por terceros, considerándose éste el producido como consecuencia de su negligencia, respondiendo de todos los daños y perjuicios, así como de los que pueda sufrir la Web o su titular.</li>
                        <li>Cualquier infracción de estas condiciones generales puede dar lugar al ejercicio de cualesquiera acciones judiciales que correspondan contra el usuario.</li>
                    </ol>
                    
                    <h4>5. Tipos de cookies según su finalidad:</h4>
                    <p>Según la finalidad para la que se traten los datos obtenidos a través de las cookies, podemos distinguir entre:</p>
                    
                    <ul>
                        <li><strong>Cookies técnicas:</strong>  Son aquéllas que permiten al usuario la navegación a través de una página web, plataforma o aplicación y la utilización de las diferentes opciones o servicios que en ella existan como, por ejemplo, controlar el tráfico y la comunicación de datos, identificar la sesión, acceder a partes de acceso restringido, recordar los elementos que integran un pedido, realizar el proceso de compra de un pedido, realizar la solicitud de inscripción o participación en un evento, utilizar elementos de seguridad durante la navegación, almacenar contenidos para la difusión de vídeos o sonido o compartir contenidos a través de redes sociales.</li>
                        <li><strong>Cookies de personalización:</strong>  Son aquéllas que permiten al usuario acceder al servicio con algunas características de carácter general predefinidas en función de una serie de criterios en el terminal del usuario como por ejemplo serian el idioma, el tipo de navegador a través del cual accede al servicio, la configuración regional desde donde accede al servicio, etc.</li>
                        <li><strong>Cookies de análisis:</strong>  Son aquéllas que permiten al responsable de las mismas, el seguimiento y análisis del comportamiento de los usuarios de los sitios web a los que están vinculadas. La información recogida mediante este tipo de cookies se utiliza en la medición de la actividad de los sitios web, aplicación o plataforma y para la elaboración de perfiles de navegación de los usuarios de dichos sitios, aplicaciones y plataformas, con el fin de introducir mejoras en función del análisis de los datos de uso que hacen los usuarios del servicio.</li>
                    </ul>
                    
                    <h4>5.1. Herramienta de Gestión de las Cookies</h4>
                    <p>Está página Web utiliza Google Analytics.</p>
                    
                    <p>Google Analytics es una herramienta gratuita de análisis web de Google que principalmente permite que los propietarios de sitios web conozcan cómo interactúan los usuarios con su sitio web. Asimismo, habilita cookies en el dominio del sitio en el que te encuentras y utiliza un conjunto de cookies denominadas "__utma" y "__utmz" para recopilar información <strong>de forma anónima</strong> y elaborar informes de tendencias de sitios web <strong>sin identificar a usuarios individuales</strong>.</p>
                    
                    <p>Para realizar las estadísticas de uso de esta Web utilizamos las cookies con la finalidad de conocer el nivel de recurrencia de nuestros visitantes y los contenidos que resultan más interesantes. De esta manera podemos concentrar nuestros esfuerzos en mejorar las áreas más visitadas y hacer que el usuario encuentre más fácilmente lo que busca. En esta Web puede utilizarse la información de su visita para realizar evaluaciones y cálculos estadísticos sobre datos anónimos, así como para garantizar la continuidad del servicio o para realizar mejoras en sus sitios Web. Para más detalles, consulte en el siguiente enlace la política de privacidad [<a href="www.google.com/intl/es/policies/privacy/" target="_blank">www.google.com/intl/es/policies/privacy/</a>]</p>

                    <h4>5.2. Cómo gestionar las Cookies en su equipo: la desactivación y eliminación de las cookies</h4>
                    <p>Todos los navegadores de Internet le permiten limitar el comportamiento de una cookie o desactivar las cookies dentro de la configuración o las opciones del navegador. Los pasos para hacerlo son diferentes para cada navegador, se pueden encontrar instrucciones en el menú de ayuda de su navegador.</p>
                    
                    <p>Si no acepta el uso de las cookies, ya que es posible gracias a los menús de preferencias o ajustes de su navegador, rechazarlas, este sitio Web seguirá funcionando adecuadamente sin el uso de las mismas.</p>
                    
                    <p>Puede usted permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la configuración de las opciones del navegador instalado en su ordenador:</p>
                    
                    <ul>
                        <li>Para más información sobre Internet Explorer <a href="http://windows.microsoft.com/es-es/internet-explorer/delete-manage-cookies#ie=ie-11" target="_blank">pulse aquí</a>.</li>
                        <li>Para más información sobre Google Chrome <a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank">pulse aquí</a>.</li>
                        <li>Para más información sobre Safari <a href="https://support.apple.com/es-es/HT201265" target="_blank">pulse aquí</a>.</li>
                        <li>Para más información sobre Mozilla Firefox <a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we" target="_blank">pulse aquí</a>.</li>
                        <li>Para más información sobre Opera <a href="http://help.opera.com/Windows/11.50/es-ES/cookies.html" target="_blank">pulse aquí</a>.</li>
                    </ul>
                    
                    <p>A través de su navegador, usted también puede ver las cookies que están en su ordenador, y borrarlas según crea conveniente. Las cookies son archivos de texto, los puede abrir y leer el contenido. Los datos dentro de ellos casi siempre está cifrado con una clave numérica que corresponde a una sesión en Internet por lo que muchas veces no tiene sentido más allá que la página web que lo escribió.</p>
                    
                    <h4>6. Consentimiento informado</h4>
                    <p>La utilización de la presente página Web por su parte, implica que <strong>Vd. presta su consentimiento expreso e inequívoco a la utilización de cookies, en los términos y condiciones previstos en esta Política de Cookies</strong>, sin perjuicio de las medidas de desactivación y eliminación de las cookies que Vd. pueda adoptar, y que se mencionan en el apartado anterior.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include("../inc_pie.php"); ?>