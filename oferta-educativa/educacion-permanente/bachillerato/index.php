<?php
require_once("../../../bootstrap.php");
require_once("../../../config.php");

if ((! isset($config['educacion_permanente']) && ! isset($config['educacion_permanente']['bachillerato'])) || (isset($config['educacion_permanente']['bachillerato']) && $config['educacion_permanente']['espa'] == false)) {
    include("../../../error404.php");
}

$cursos = array();
$result_cursos = mysqli_query($db_con, "SELECT `nomcurso` FROM `cursos` WHERE `nomcurso` LIKE '%Bach.Pers.Adul.%' ORDER BY `nomcurso` ASC") or die (mysqli_error($db_con));
while ($row_cursos = mysqli_fetch_array($result_cursos)) {

  $asignaturas = array();
  $result_asignaturas = mysqli_query($db_con, "SELECT DISTINCT `nombre` FROM `asignaturas` WHERE `curso` = '" . $row_cursos['nomcurso'] . "' AND `abrev` NOT LIKE '%\_%' AND `nombre` NOT LIKE '%Tutoría%' AND `nombre` <> 'Pedagogía Terapéutica' AND nombre <> 'Refuerzo Pedagógico' ORDER BY `nombre` ASC");
  while ($row_asignaturas = mysqli_fetch_array($result_asignaturas)) {
    array_push($asignaturas, $row_asignaturas['nombre']);
  }
  mysqli_free_result($result_asignaturas);

  $curso = array(
    'nombre'      => $row_cursos['nomcurso'],
    'asignaturas' => $asignaturas
  );

  array_push($cursos, $curso);
}
mysqli_free_result($result_cursos);
unset($curso);

$pagina['titulo'] = 'Bachillerato para Personas Adultas (BTOPA)';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Información sobre ".$pagina['titulo'];
$pagina['meta']['meta_type'] = "article";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-9">

                  <p>El Bachillerato tiene como finalidad proporcionar al alumnado formación, madurez intelectual y humana, conocimientos y habilidades que les permitan desarrollar funciones sociales e incorporarse a la vida activa con responsabilidad y competencia. Asimismo, capacitará al alumnado para acceder a la educación superior.</p>

                  <h4>Requisitos de acceso</h4>
                  <p>Para cursar estas enseñanzas en régimen de personas adultas debes ser mayor de dieciocho años o cumplirlos en el año natural en que comience el curso académico.</p>

                  <p>De manera excepcional, también puedes acceder a las enseñanzas de personas adultas si eres mayor de 16 años, o los cumples en el año natural en que comienza el curso académico, acreditando alguna de estas situaciones:</p>
                  <ul>
                    <li>Ser persona trabajadora por cuenta propia o ajena de manera que no puedas acudir al centro educativo de carácter ordinario.</li>
                    <li>Ser deportista de rendimiento en Andalucía o de alto rendimiento o alto nivel.</li>
                    <li>Encontrarte en situación personal extraordinaria de enfermedad, discapacidad o cualquier otra situación que  te  impida  cursar  las  enseñanzas  en  régimen  ordinario,  quedando  incluidas  en  este  supuesto  las  personas víctimas de la violencia de género y las víctimas de terrorismo, así como sus hijos e hijas, y las personas que se encuentren en situación de dificultad social extrema o riesgo de exclusión.</li>
                    <li>Estar interno o interna en centros penitenciarios o de menores sujetas a medidas de privación de libertad por sentencia judicial.</li>
                  </ul>

                  <hr>

                  <h4>Requisitos académicos</h4>
                  <p>Si deseas acceder a Bachillerato para personas adultas necesitas cumplir alguno de los siguientes requisitos académicos:</p>

                  <ul>
                    <li>Poseer el título de Graduado en la ESO o equivalente.</li>
                    <li>Poseer el título de Técnico de Formación Profesional o equivalente.</li>
                    <li>Si la modalidad de Bachillerato que quieres cursar es la de Arte también puedes acceder si tienes el título de Técnico de Artes Plásticas y Diseño.</li>
                  </ul>

                  <p>Si tienes estudios previos consulta las diferentes equivalencias para saber si tienes alguna materia ya superada. En este caso no tendrías que cursar dichas materias de nuevo.</p>

                  <p><a href="http://www.juntadeandalucia.es/educacion/portals/web/educacion-permanente/bachillerato/requisitos/-/libre/detalle/Fu9A/prueba-3-equivalencias-1" target="_blank">Equivalencia de las materias de Bachillerato - LOMCE</a></p>

                  <hr>

                  <h4>Admisión</h4>

                  <p>Para acceder a estas enseñanzas tienes que solicitar admisión si te encuentras en alguno de estos casos:</p>

                  <ul>
                    <li>Si no has estado matriculado/a con anterioridad.</li>
                    <li>Si quieres retomar tus estudios, si los has interrumpido por cualquier motivo y no fuiste alumno/a el curso anterior.</li>
                    <li>Si ya formas parte del alumnado del centro y quieres cambiar de modalidad, en el caso de que el centro oferte las modalidades de presencial y semipresencial.</li>
                    <li>Si deseas cursar enseñanzas a distancia en el Instituto de Enseñanzas a Distancia de Andalucía (IEDA) tendrás que solicitar admisión en cualquier caso.</li>
                    <li>Si procedes de otro centro.</li>
                  </ul>

                  <p>Para realizar el trámite utiliza el impreso disponible y tras rellenar tus datos dirígelo al centro docente en el que quieras cursar tus estudios. Consulta en el apartado de Tramitación cómo puedes realizar tu solicitud de admisión.</p>

                  <p>Para rellenar tu impreso ten en cuenta las siguientes indicaciones:</p>

                  <ul>
                    <li>Solicitas admisión en un único centro.</li>
                    <li>Puedes solicitar admisión para materias sueltas.</li>
                    <li>Especifica en qué modalidad deseas cursar cada materia si el centro oferta diferentes modalidades.</li>
                  </ul>

                  <p>Si has cursado con anterioridad alguna materia de Bachillerato o de enseñanzas equivalentes de sistemas educativos anteriores puedes consultar su equivalencia.</p>

                  <p>Los plazos para solicitar admisión son diferentes según optes por la modalidad presencial o semipresencial, o la modalidad a distancia. Consulta todos los plazos en el calendario.</p>

                  <p>Deberás tener en cuenta que la matrícula en las enseñanzas a distancia conlleva el pago de unas tasas. Existen reducciones en el pago de tasas por diversos motivos. Consulta toda la información referente en el portal del Instituto de Enseñanzas a Distancia de Andalucía.</p>

                  <hr>

                  <h4>Adjudicación de plazas: modalidad presencial y semipresencial</h4>

                  <p>Durante el proceso de escolarización se publicarán los listados de personas admitidas y excluidas.</p>

                  <ol>
                    <li>Publicación de <strong>relación provisional</strong> de alumnado admitido y excluido. Se publica en los 5 días hábiles tras la finalización del plazo de admisión. Este listado se hará público en los tablones de anuncios de los centros.</li>
                    <li>Plazo de <strong>alegaciones</strong>. Durante los dos días hábiles tras la publicación de listado provisional podrás realizar alegaciones si no aparecen tus datos en la consulta anterior o no estás de acuerdo con lo publicado.</li>
                    <li>Publicación de <strong>relación definitiva</strong> de alumnado admitido y excluido. Se realizará antes del inicio del periodo de matrícula y se publicará en los tablones de anuncios de los centros.</li>
                  </ol>

                  <hr>

                  <h4>Estructura</h4>

                  <p>La oferta educativa en Bachillerato para Personas Adultas en nuestro centro es la siguiente:</p>

                  <div class="row">

                    <?php foreach ($cursos as $curso): ?>
                    <div class="col-md-4" style="margin-bottom: 15px;">
                      <?php
                      $curso['nombre'] = str_replace(' (Lomce)', '', $curso['nombre']);
                      $curso['nombre'] = str_replace('Bach.Pers.Adul.', 'BTOPA', $curso['nombre']);
                      $curso['nombre'] = str_replace('(Semipres.)', '<span class="badge">Semipresencial</span>', $curso['nombre']);
                      $curso['nombre'] = str_replace('(Pres.)', '<span class="badge">Presencial</span>', $curso['nombre']);
                      ?>
                      <h6 class="text-primary"><?php echo $curso['nombre']; ?></h6>

                      <ul>
                        <?php foreach ($curso['asignaturas'] as $asignatura): ?>
                        <li><?php echo $asignatura; ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                    <?php endforeach; ?>

                  </div>

                  <h4>Modalidades y oferta educativa</h4>
                  <p>Estas enseñanzas se rigen por criterios de flexibilidad, lo que permite una mayor participación de la población andaluza en enseñanzas postobligatorias.</p>
                  <p>Las principales novedades son:</p>
                  <ul>
                    <li>Posibilidad de realizar esta etapa en las modalidades presencial, semipresencial y a distancia (on-line).</li>
                    <li>Posibilidad de matrícula parcial por materias en todas las modalidades de enseñanza.</li>
                    <li>Reconocimiento y equivalencia de aprendizajes adquiridos. Tanto para las personas que acceden a bachillerato por primera vez como para aquellas que provienen del régimen ordinario de estas enseñanzas. Además se reconocerán aquellas materias superadas en las  pruebas para la obtención del Título de Bachiller para personas mayores de 20 años. Estas materias, una vez superadas, no deben ser cursadas de nuevo.</li>
                  </ul>

                  <hr>

                  <h4>Modalidad presencial</h4>

                  <p>Esta modalidad de enseñanza se basa en la asistencia regular y la atención personalizada por parte del profesorado en cada una de las materias en las que te matricules.</p>

                  <p>Podrás matricularte por cursos completos a lo largo de dos cursos académicos o por bloques de materias en tres cursos académicos.</p>

                  <p>La asistencia al centro es de 27 horas semanales tanto en 1º como en 2º. Durante estas horas se trabajan las materias de las diferentes modalidades de bachillerato que se ofertan en Educación Permanente: Modalidad de Humanidades y Ciencias Sociales, de Ciencias, y de Artes.</p>

                  <hr>

                  <h4>Modalidad semipresencial</h4>

                  <p>Bachillerato para personas adultas en modalidad semipresencial se imparte mediante la combinación de sesiones lectivas colectivas presenciales, de obligada asistencia para el alumnado, y sesiones de docencia telemática. Las sesiones presenciales son 12 tanto en 1º como en 2º de Bachillerato. El resto de actividades y trabajos se realiza fuera del centro en el tiempo del que dispone cada persona en función de su situación.</p>

                  <p>Esta modalidad permite al alumnado adulto formarse para la obtención de títulos y certicados oficiales del sistema educativo con menos tiempo de presencia física en el centro, lo cual les permite conciliar dicha formación con su vida familiar y laboral.</p>

                  <p>Las sesiones de docencia presencial tendrán como objetivo facilitar al alumnado las ayudas pertinentes en la realización de tareas, resolver dudas respecto a los aspectos esenciales del currículo, orientar hacia el uso de las herramientas de comunicación empleadas por esta modalidad de enseñanza, afianzar las interacciones cooperativas entre el alumnado, promover la adquisición de los conocimientos, competencias básicas o profesionales que correspondan y, en su caso, reforzar la práctica de las destrezas orales.</p>

                  <p>Es importante que el alumnado interesado en realizar sus estudios en modalidad semipresencial tenga en cuenta las siguientes consideraciones:</p>

                  <ul>
                    <li>Disponer de acceso a equipo informático y conexión a internet de banda ancha.</li>
                    <li>Conocimientos de navegación básica por internet y correo electrónico para el acceso al aula virtual. La información para el acceso a dicha aula virtual, y las herramientas y acciones básicas para la navegación por la misma se facilitan al alumnado en el centro a principio de curso.</li>
                    <li>Capacidad de autogestión del tiempo para realizar tareas y actividades en la plataforma a través de la cual tendrá acceso a los materiales y comunicación con el profesorado y el resto del alumnado que forma el grupo.</li>
                  </ul>

                  <h4>Salidas</h4>
                  <p>El título de Bachiller permitirá acceder a:</p>

                  <ul>
                    <li>Ciclos Formativos de Grado Superior</li>
                    <li>Evaluación del Bachillerato para el acceso a la Universidad (EBAU)</li>
                    <li>Enseñanzas artísticas de grado superior (tras superar una prueba específica)</li>
                    <li>Prueba para la obtención directa del título de Técnico Superior (para mayores de 20 años)</li>
                  </ul>

                  <hr>

                  <h4>Tramitación</h4>
                  <p>Si deseas cursar ESO o Bachillerato para personas adultas tendrás que solicitar admisión en primer lugar y realizar tu matrícula posteriormente.</p>

                  <p>En ambos casos puedes realizar los trámites:</p>
                  <ul>
                    <li>Mediante proceso telemático a través de Secretaría virtual, sin certificado digital (cumplimentación en línea), con certificado digital y con clave iCAT. Esta es la forma más recomendable. En este caso el procedimiento varía si quieres acceder a las enseñanzas en las modalidades presencial y semipresencial o a distancia.</li>
                    <li>Enviar tu documentación por correo postal certificado al centro docente, siempre con la solicitud y su copia sellada en correos con la fecha de envío antes de introducirla en el sobre. De esta manera puedes conservar tu copia como resguardo.</li>
                    <li>Presentar tu documentación en persona directamente en el centro docente.</li>
                    <li>Entregar tu documentación en los registros de cualquier Órgano Administrativo que pertenezca a la Administración General del Estado, a cualquiera de las Administraciones de las Comunidades Autónomas y a las Entidades Locales (esta opción es la menos recomendable por el tiempo que transcurre entre tu entrega y la recepción de tu documentación en el centro).</li>
                  </ul>

                  <h4>Matrícula: presencial y semipresencial</h4>
                  <p>Para cursar estas enseñanzas debes formalizar tu matrícula si te encuentras en alguno de los siguientes casos:</p>

                  <ul>
                    <li>Si has sido admitido/a en un centro deberás formalizar tu matrícula en dicho centro.</li>
                    <li>Si ya realizaste estudios el curso anterior y deseas continuarlos en el mismo centro, no necesitas solicitar admisión pero si formalizar tu matrícula entregando el impreso correspondiente debidamente cumplimentado.</li>
                    <li>Si ya realizaste estudios el curso anterior y tienes ámbitos o materias pendientes de superación, tu matrícula será provisional y según las decisiones adoptadas por los equipos docentes y la normativa de aplicación.</li>
                  </ul>

                  <h6>Plazo ordinario</h6>

                  <p>Puedes formalizar tu matrícula mediante el impreso disponible o mediante Secretaría Virtual. Consulta en Tramitación e impresos para saber más. Es importante tener en cuenta que el plazo varía si estás matriculándote en enseñanzas en modalidad presencial o semipresencial, o en enseñanzas a distancia. Consulta el calendario para conocer las fechas.</p>

                  <p>Los plazos para formalizar tu matrícula son diferentes según optes por la modalidad presencial o semipresencial, o la modalidad a distancia. Consulta todos los plazos en el calendario.</p>

                  <p>Deberás tener en cuenta que la matrícula en las enseñanzas a distancia conlleva el pago de unas tasas. Existen reducciones en el pago de tasas por diversos motivos. Consulta toda la información referente en el portal del <a href="http://www.juntadeandalucia.es/educacion/webportal/web/ieda" target="_blank">Instituto de Enseñanzas a Distancia de Andalucía</a>.</p>

                  <h6>Plazo extraordinario</h6>

                  <p>Si tras el procedimiento ordinario de matrícula hubiera plazas vacantes, la dirección del centro docente público matriculará por orden de llegada, o en el caso de las enseñanzas a distancia por orden de recepción de la solicitud, a aquellas personas interesadas que incluso no habiendo solicitado admisión en plazo, cumplan los requisitos.</p>

                  <p>De manera excepcional puedes solicitar plaza vacante en cualquiera de las modalidades si existiera,  solicitándolo directamente al centro a lo largo del primer trimestre del curso.</p>

                  <p>Para cursar estas enseñanzas en su totalidad dispones de seis convocatorias. Ten en cuenta que no se contempla la anulación, renuncia o baja de matrícula, por lo que, una vez formalizada tu matrícula, con cada curso, agotas dos convocatorias.</p>

                  <hr>

                  <h4>Impresos admisión y matrícula: modalidad presencial y semipresencial</h4>
                  <ul>
                    <li><a href="http://www.juntadeandalucia.es/educacion/portals/abaco-portlet/content/90cbec9f-9c9f-41ab-8fce-278b1ec4926c" target="_blank">Impreso admisión Bachillerato modalidades presencial y semipresencial</a></li>
                    <li><a href="http://www.juntadeandalucia.es/educacion/portals/abaco-portlet/content/024ae8a0-543f-4261-9f9a-e73409fb6053" target="_blank">Impreso matriculación Bachillerato modalidades presencial y semipresencial</a></li>
                  </ul>

                </div>

            </div>
        </div>
    </div>

    <?php include("../../../inc_pie.php"); ?>
