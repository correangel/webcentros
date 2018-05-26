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
                    <p>El <?php echo $config['centro_denominacion']; ?> (centro código <?php echo $config['centro_codigo']; ?>), sito en <?php echo $config['centro_direccion']; ?>, <?php echo $config['centro_localidad']; ?>, <?php echo $config['centro_codpostal']; ?>, <?php echo $config['centro_provincia']; ?>, es la entidad titular del sitio Web.
                    
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

                    <h4>5. Política de Privacidad</h4>
                    
                    <h5>5.1. ¿Quién es el responsable del tratamiento de tus datos?</h5>
                    <p>El responsable del tratamiento de tus datos es:</p>

                    <p>Secretaría General Técnica de la Consejería de Educación de la Junta de Andalucía, con dirección en Avda. Juan Antonio de Vizarrón, s/n, Edificio Torretriana. 41071, Sevilla.</p>

                    <h5>5.2. Recopilación y uso de los datos de carácter personal</h5>
                    <p>Se considera información personal cualquier dato que pueda utilizarse para identificar a una persona en particular o ponerse en contacto con ella.</p>

                    <p>Es posible que tengas que proporcionar datos de carácter personal cuando contactes con el <?php echo $config['centro_denominacion']; ?>. El <?php echo $config['centro_denominacion']; ?> puede compartir los datos de carácter personal y utilizarlos de acuerdo con la presente Política de Privacidad. Asimismo, pueden combinarlos con otros datos para suministrar y mejorar los servicios y contenidos. No estás obligado a facilitar la información personal que te soliciten pero, si decides no proporcionarla, habrá muchas ocasiones en las que no podrás utilizar los servicios, o no recibirás respuestas a las preguntas que pudieras tener.</p>
                    
                    <p>A continuación se muestran algunos ejemplos de los tipos de información personal que el <?php echo $config['centro_denominacion']; ?> puede recopilar y los posibles usos que puede darle:</p>

                    <h6>Qué datos de carácter personal se recopilan y cómo se usa tu información personal</h6>
                    <p>Cuando utilizas el formulario de contacto de esta web, se recopila su nombre y apellidos y su dirección de correo electrónico, con el fin de poder responder a sus preguntas.</p>

                    <p>Cuando accede a la página de <a href="<?php echo WEBCENTROS_DOMINIO; ?>alumnado/" target="_blank">Alumnado</a> para consultar la información académica, se recopilan la dirección de correo electrónico y número de teléfono móvil, con el fin de poder actualizar o combinar la información de contacto ofrecida por el alumno o tutores legales en la matrícula para enviar notificaciones vía SMS o correo eléctronico.</p>

                    <p>Cuando accede a la <a href="<?php echo WEBCENTROS_DOMINIO; ?>intranet/" target="_blank">Intranet</a> se recopilan la dirección de correo electrónico y número de teléfono móvil, con el fin de poder enviar notificaciones vía SMS o correo eléctronico.</p>
                    
                    <p>Como esta información es fundamental para tu interacción con el <?php echo $config['centro_denominacion']; ?>, no puedes optar por rechazar la recepción de estas comunicaciones.</p>
                    
                    <p>También se pueden utilizar tus datos de carácter personal para fines internos, incluyendo análisis de datos y estadísticas, con el fin de mejorar los servicios y contenidos.</p>

                    <h6>Recopilación y uso de los datos de carácter no personal</h6>
                    <p>También se recopilan datos de manera que no es posible asociarlos, por sí solos, directamente a una persona determinada. El <?php echo $config['centro_denominacion']; ?> puede recopilar, tratar, transferir y divulgar datos de carácter no personal con cualquier fin.</p>
                    
                    <p>Estos son algunos ejemplos de las categorías de datos de carácter no personal que puede recopilar el <?php echo $config['centro_denominacion']; ?> y los posibles usos que puede darle:</p>

                    <p>Es posible que se recopilen datos tales como dirección IP, dirección URL de referencia, información sobre su dispositivo como nombre y versión del sistema operativo, nombre y versión del navegador e idioma, en la que se utiliza este sitio web, para conocer mejor la conducta de los usuarios y mejorar los servicios y contenidos.</p>

                    <p>Si se combinan datos de carácter no personal con datos de carácter personal, los datos combinados serán tratados como datos de carácter personal en tanto sigan estando combinados.</p>

                    <h5>5.3. Divulgación a terceros</h5>

                    <p>En algunas ocasiones, el <?php echo $config['centro_denominacion']; ?> puede facilitar determinados datos de carácter personal a empresas con los que trabaja, como proveedores de productos y servicios. El <?php echo $config['centro_denominacion']; ?> únicamente compartirá tus datos de carácter personal para suministrar o mejorar los servicios y contenidos, y no los compartirá con ningún tercero con fines de marketing.</p>

                    <h6>Proveedores de servicios</h6>

                    <p>El <?php echo $config['centro_denominacion']; ?> comparte datos de carácter personal con empresas que se dedican, entre otras actividades, a prestar servicios de tratamiento de datos, alojamiento de contenidos, servicio de envío de correo electrónico y mensajes de texto SMS. Estas empresas están obligadas a proteger tus datos y pueden estar situadas en cualquiera de los países en los que desarrolla su actividad.</p>

                    <h6>Otros terceros</h6>

                    <p>Es posible que el <?php echo $config['centro_denominacion']; ?> tenga la obligación de divulgar tus datos de carácter personal por imperativo legal, en el marco de un procedimiento judicial o por requerimiento de una autoridad pública o gubernamental, tanto de tu país de residencia como del extranjero. Asimismo, se puede divulgar información sobre tu persona si se considera que dicha divulgación es necesaria o conveniente por razones de seguridad nacional, para cumplir la legislación vigente o por otros motivos importantes de orden público.</p>

                    <h5>5.4. Acceso a los datos de caracter personal</h5>

                    <p>Puedes comprobar que tu información de contacto sean correctas, estén completas y se mantengan actualizadas en todo momento accediendo a la página de <a href="<?php echo WEBCENTROS_DOMINIO; ?>alumnado/" target="_blank">Alumnado</a> si eres alumno o tutor legal, o accediendo a la <a href="<?php echo WEBCENTROS_DOMINIO; ?>intranet/" target="_blank">Intranet</a> si eres profesor o personal de administración y servicios.</p>

                    <p>Las solicitudes de acceso, rectificación, cancelación u oposición pueden realizarse enviando un escrito a la Secretaría General Técnica de la Consejería de Educación de la Junta de Andalucía, con dirección en Avda. Juan Antonio de Vizarrón, s/n, Edificio Torretriana. 41071, Sevilla..</p>

                    <h5>5.5. ¿Durante cuanto tiempo conservaremos tus datos?</h5>
                    <p>El plazo de conservación de tus datos dependerá de las finalidades para las que los tratemos, según lo explicado a continuación:</p>
                    
                    <p><strong>Gestionar tu registro como usuario de la plataforma:</strong> Trataremos tus datos durante un periodo de hasta 6 años si eres empleado o alumno/a matriculado.</p>

                    <p><strong>Atención a los usuarios a través del formulario de contacto:</strong> Trataremos tus datos durante el tiempo que sea necesario para atender tu solicitud o petición.</p>

                    <p><strong>Análisis de usabilidad y de calidad:</strong> Trataremos tus datos puntualmente durante el tiempo en el que procedamos a realizar una acción o hasta que anonimicemos tus datos de navegación.</p>

                    <h4>6. Política de Cookies</h4>
                    <p>Para que este sitio funcione adecuadamente, a veces instalamos en los dispositivos de los usuarios pequeños ficheros de datos, conocidos como cookies. La mayoría de los grandes sitios web también lo hacen.</p>
                    
                    <p>Una cookie es un pequeño fichero de texto que los sitios web instalan en el ordenador o el dispositivo móvil de los usuarios que los visitan. Las cookies hacen posible que el sitio web recuerde las acciones y preferencias del usuario (identificador de inicio de sesión, idioma, tamaño de letra y otras preferencias de visualización), para que este no tenga que volver a configurarlos cuando regrese al sitio o navegue por sus páginas.</p>
                    
                    <?php if (isset($config['google_analytics']['tracking_id']) && ! empty($config['google_analytics']['tracking_id'])): ?>
                    <h5>6.1. Herramienta de Gestión de las Cookies</h5>
                    <p>Esta página web utiliza Google Analytics, un servicio analítico de web prestado por Google, Inc., una compañía de Delaware cuya oficina principal está en 1600 Amphitheatre Parkway, Mountain View (California), CA 94043, Estados Unidos (“Google”).</p>
                    
                    <p>Google Analytics utiliza “cookies”, que son archivos de texto ubicados en su ordenador, para ayudar al website a analizar el uso que hacen los usuarios del sitio web. La información que genera la cookie acerca de su uso del website (incluyendo su dirección IP) será directamente transmitida y archivada por Google en los servidores de Estados Unidos.</p>
                    
                    <p>Google usará esta información por cuenta nuestra con el propósito de seguir la pista de su uso del website, recopilando informes de la actividad del website y prestando otros servicios relacionados con la actividad del website y el uso de Internet.</p>
                    
                    <p>Google podrá transmitir dicha información a terceros cuando así se lo requiera la legislación, o cuando dichos terceros procesen la información por cuenta de Google.</p>
                    
                    <p>Google no asociará su dirección IP con ningún otro dato del que disponga Google.</p>

                    <p>Puede Usted rechazar el tratamiento de los datos o la información rechazando el uso de cookies mediante la selección de la configuración apropiada de su navegador, sin embargo, debe Usted saber que si lo hace puede ser que no pueda usar la plena funcionabilidad de este website. Al utilizar este website Usted consiente el tratamiento de información acerca de Usted por Google en la forma y para los fines arriba indicados.</p>
                    <?php endif; ?>

                    <h5><?php echo (isset($config['google_analytics']['tracking_id']) && ! empty($config['google_analytics']['tracking_id'])) ? '6.2.' : '6.1'; ?> Cómo gestionar las Cookies en su equipo: la desactivación y eliminación de las cookies</h5>
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
                    
                    <br>
                    
                    <div class="alert alert-info text-center">
                        Las Condiciones Generales de este sitio web se actualizaron el <?php echo strftime('%d de %B de %Y', strtotime(date("Y-m-d", filectime('index.php')))); ?>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../inc_pie.php"); ?>