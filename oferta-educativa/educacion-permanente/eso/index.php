<?php
require_once("../../../bootstrap.php");
require_once("../../../config.php");

if ((! isset($config['educacion_permanente']) && ! isset($config['educacion_permanente']['espa'])) || (isset($config['educacion_permanente']['espa']) && $config['educacion_permanente']['espa'] == false)) {
    include("../../../error404.php");
}

$cursos = array();
$result_cursos = mysqli_query($db_con, "SELECT `nomcurso` FROM `cursos` WHERE `nomcurso` LIKE '%Esa%' ORDER BY `nomcurso` ASC") or die (mysqli_error($db_con));
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

$pagina['titulo'] = 'Educación Secundaria para Personas Adultas (ESPA)';

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

                  <p>La Educación Secundaria para Personas Adultas (ESPA) en su modalidad presencial es la formación que, incorporando las oportunas adaptaciones para las diferentes características de las personas adultas, conduce al título oficial de Graduado en Educación Secundaria Obligatoria.</p>

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
                  <p>Si quieres cursar la ESO para personas adultas no necesitas tener ninguna titulación previa, aunque es conveniente que realices la Formación Básica si tienes dificultades de lectoescritura.</p>

                  <ul>
                    <li>Si no tienes estudios previos, o un certificado de los mismos, puedes realizar una prueba de valoración inicial pidiéndolo a la vez que solicitas admisión en el Nivel I. Según los resultados de esta prueba podrás acceder a NIvel I o incluso a Nivel II directamente.</li>
                    <li>Si ya realizaste algún tipo de enseñanza y dispones del certificado correspondiente, puedes acceder a Nivel I o Nivel II de la ESO para personas adultas. Consulta los siguientes casos:
                      <ul>
                        <li><strong>Accedes a Nivel 1:</strong>
                          <p>Con certificado de estudios primarios. <small class="text-muted">Ley 17/7/1945, de Educación Primaria, y  Ley 21/12/1965, de Reforma de la Educación Primaria, expedido con anterioridad a la finalización del curso 1975/76.</small></p>
                          <p>Plan educativo de formación básica o equivalente.</p>
                          <p>1º y 2º curso de educación secundaria obligatoria y no haber promocionado a tercero.</p>
                          <p>Primer ciclo de educación secundaria obligatoria en régimen de personas adultas y no haber promocionado al segundo ciclo.</p>
                          <p>Valoración positiva para la adscripción a este nivel tras haber realizado la prueba de valoración inicial en el acceso a la educación secundaria obligatoria para personas adultas. <small class="text-muted">Orden de 10 de agosto de 2007, por la que se regula la Eduación Secundaria Obligatoria para personas adultas.</small></p>
                        </li>
                        <li><strong>Accedes a Nivel 2:</strong>
                          <p>Sin estudios previos o sin certificado de los mismos, tras haber realizado la prueba de valoración inicial y según criterio del centro.</p>
                          <p>8º de EGB (Educación General Básica) y título de Graduado Escolar o Certificado de Escolaridad. <small>Real Decreto 986/1991, de 14 de junio</small></p>
                          <p>Graduado Escolar. <small>Ley 14/1970 de 4 de agosto</small></p>
                          <p>1º de BUP (Bachillerato Unificado Polivalente). <small>Ley 14/1970 de 4 de agosto</small></p>
                          <p>Bachiller Elemental. <small>Ley de 26 de febrero de 1953, sobre ordenación de las Enseñanzas medias.</small></p>
                          <p>4º de Bachiller completo, o 5º o 6º con materias pendientes. <small>Plan 1957</small></p>
                          <p>1º curso del primer ciclo experimental. <small>Reforma de las Enseñanzas medias. Implantación anticipada de la Ley Orgánica 1/1990</small></p>
                          <p>2º curso de educación secundaria obligatoria.</p>
                          <p>Primer ciclo de educación secundaria obligatoria en régimen de personas adultas.</p>
                          <p>Valoración positiva en uno o varios ámbitos para la adscripción a este nivel tras haber realizado la prueba de valoración inicial.</p>
                        </li>
                      </ul>
                    </li>
                    <li>Si realizaste estudios en el extranjero debes homologarlos previamente dirigiéndote a la Alta Inspección de Educación, en la Subdelegación de Gobierno de tu provincia.</li>
                  </ul>

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
                    <li>Puedes solicitar admisión por ámbitos sueltos.</li>
                    <li>Especifica en qué modalidad deseas cursar cada ámbito si el centro oferta diferentes modalidades.</li>
                  </ul>

                  <p>Si has cursado con anterioridad algún ámbito o enseñanzas equivalentes de sistemas educativos anteriores puedes <a href="http://www.juntadeandalucia.es/educacion/portals/web/educacion-permanente/eso/equivalencias" target="_blank">consultar aquí su equivalencia</a>. En tal caso no necesitas volver a cursarlo.</p>

                  <p>Los plazos para solicitar admisión son diferentes según optes por la modalidad presencial o semipresencial, o la modalidad a distancia. Consulta todos los plazos en el calendario.</p>

                  <hr>

                  <h4>Adjudicación de plazas: modalidad presencial y semipresencial</h4>

                  <p>Durante el proceso de escolarización se publicarán los listados de personas admitidas y excluidas.</p>

                  <ol>
                    <li>Publicación de <strong>relación provisional</strong> de alumnado admitido y excluido. Se publica en los 5 días hábiles tras la finalización del plazo de admisión. Este listado se hará público en los tablones de anuncios de los centros.</li>
                    <li>Plazo de <strong>alegaciones</strong>. Durante los dos días hábiles tras la publicación de listado provisional podrás realizar alegaciones si no aparecen tus datos en la consulta anterior o no estás de acuerdo con lo publicado.</li>
                    <li>Publicación de <strong>relación definitiva</strong> de alumnado admitido y excluido. Se realizará antes del inicio del periodo de matrícula y se publicará en los tablones de anuncios de los centros.</li>
                  </ol>

                  <hr>

                  <h4>Modalidades y oferta educativa</h4>
                  <p>En Educación Permanente se oferta la Educación Secundaria Obligatoria para personas adultas. Estas enseñanzas se rigen por criterios de flexibilidad para facilitar tu incorporación al sistema educativo. Las principales diferencias respecto a la Educación Secundaria Obligatoria en régimen ordinario son:</p>
                  <ul>
                    <li>Posibilidad de realizar esta etapa en las modalidades presencial, semipresencial y a distancia (on-line).</li>
                    <li>Tiene una duración de dos cursos escolares: Nivel I (1º y 2º de la ESO en régimen ordinario) y Nivel II (3º y 4º de la ESO en régimen ordinario).</li>
                    <li>Los contenidos se agrupan por ámbitos, no por materias: ámbito de comunicación, ámbito científico-tecnológico y ámbito social.</li>
                    <li>Posibilidad de matrícula parcial por ámbitos en todas las modalidades.</li>
                    <li>econocimiento y equivalencia de aprendizajes adquiridos, tanto si accedes a la ESO por primera vez como si provienes del régimen ordinario de estas enseñanzas. Además se reconocerán aquellos ámbitos superadas en las  pruebas para la obtención del Título de Graduado en ESO para mayores de 18 años. Estos ámbitos, una vez superados, no deben ser cursados de nuevo.</li>
                  </ul>

                  <p>Esta modalidad de enseñanza se basa en la asistencia regular y la atención personalizada por parte del profesorado en cada uno de los ámbitos en los que te matricules.</p>

                  <p>La ESO para personas adultas en la modalidad presencial se imparte tanto en Institutos de Enseñanza Secundaria (IES) de las redes de Centros de Educación Permanente como en los Institutos Provinciales de Educación Permanente (IPEP).</p>

                  <p>La asistencia al centro es de 20 horas semanales tanto en el Nivel I como en el Nivel II. En estas horas trabajarás los diferentes contenidos organizados por ámbitos y con la siguiente distribución:</p>
                  <ul>
                    <li>Ámbito Científico-tecnológico: 8 horas</li>
                    <li>Ámbito de Comunicación: 7 horas</li>
                    <li>Ámbito Social: 5 horas</li>
                  </ul>

                  <hr>

                  <h4>Estructura</h4>

                  <p>La oferta educativa en Educación Secundaria para Personas Adultas en nuestro centro es la siguiente:</p>

                  <div class="row">

                    <?php foreach ($cursos as $curso): ?>
                    <div class="col-md-4" style="margin-bottom: 15px;">
                      <?php
                      $curso['nombre'] = str_replace('Bach.Pers.Adul.', 'BTOPA', $curso['nombre']);
                      $curso['nombre'] = str_replace('Semipresencial', '<span class="badge">Semipresencial</span>', $curso['nombre']);
                      $curso['nombre'] = str_replace('Presencial', '<span class="badge">Presencial</span>', $curso['nombre']);
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

                  <hr>

                  <h4>Salidas</h4>
                  <p>El título de Graduado en Educación Secundaria Obligatoria permitirá acceder a:</p>

                  <ul>
                    <li>Bachillerato</li>
                    <li>Formación Profesional de Grado Medio</li>
                    <li>Enseñanzas profesionales de artes plásticas y diseño de grado medio (tras superar prueba específica)</li>
                    <li>Enseñanzas deportivas de grado medio (tras superar una prueba específica o acreditar un mérito deportivo)</li>
                    <li>Prueba para la obtención directa del título de Técnico (mayores de 18 años)</li>
                  </ul>

                  <hr>

                  <h4>Tramitación</h4>
                  <p>Si deseas cursar ESO para personas adultas tendrás que solicitar admisión en primer lugar y realizar tu matrícula posteriormente.</p>

                  <p>En ambos casos puedes realizar los trámites:</p>
                  <ul>
                    <li>Mediante proceso telemático a través de Secretaría virtual, sin certificado digital (cumplimentación en línea), con certificado digital y con clave iCAT. Esta es la forma más recomendable. En este caso el procedimiento varía si quieres acceder a las enseñanzas en las modalidades presencial y semipresencial o a distancia.</li>
                    <li>Enviar tu documentación por correo postal certificado al centro docente, siempre con la solicitud y su copia sellada en correos con la fecha de envío antes de introducirla en el sobre. De esta manera puedes conservar tu copia como resguardo.</li>
                    <li>Presentar tu documentación en persona directamente en el centro docente.</li>
                    <li>Entregar tu documentación en los registros de cualquier Órgano Administrativo que pertenezca a la Administración General del Estado, a cualquiera de las Administraciones de las Comunidades Autónomas y a las Entidades Locales (esta opción es la menos recomendable por el tiempo que transcurre entre tu entrega y la recepción de tu documentación en el centro).</li>
                  </ul>

                  <hr>

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
                    <li><a href="http://www.juntadeandalucia.es/educacion/portals/abaco-portlet/content/7f3ef618-a670-482e-b242-f2aa6e38497a" target="_blank">Impreso admisión ESO modalidades presencial y semipresencial</a></li>
                    <li><a href="http://www.juntadeandalucia.es/educacion/portals/abaco-portlet/content/d70f2633-0489-46e6-9d1e-2927458e5801" target="_blank">Impreso matriculación ESO modalidades presencial y semipresencial</a></li>
                  </ul>

                </div>

            </div>
        </div>
    </div>

    <?php include("../../../inc_pie.php"); ?>
