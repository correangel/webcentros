<?php
require_once("../../../bootstrap.php");
require_once("../../../config.php");

if ((! isset($config['educacion_permanente']) && ! isset($config['educacion_permanente']['espa'])) || (isset($config['educacion_permanente']['espa']) && $config['educacion_permanente']['espa'] == false)) {
    include("../../../error404.php");
}

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

                  <h4>Requisitos académicos</h4>
                  <p>Si quieres cursar la ESO para personas adultas no necesitas tener ninguna titulación previa, aunque es conveniente que realices la Formación Básica si tienes dificultades de lectoescritura.</p>

                  <ul>
                    <li>Si no tienes estudios previos, o un certificado de los mismos, puedes realizar una prueba de valoración inicial pidiéndolo a la vez que solicitas admisión en el Nivel I. Según los resultados de esta prueba podrás acceder a NIvel I o incluso a Nivel II directamente.</li>
                    <li>Si ya realizaste algún tipo de enseñanza y dispones del certificado correspondiente, puedes acceder a Nivel I o Nivel II de la ESO para personas adultas. Consulta los siguientes casos:
                      <ul>
                        <li>Accedes a Nivel 1:
                          <p>Con certificado de estudios primarios. <small class="text-muted">Ley 17/7/1945, de Educación Primaria, y  Ley 21/12/1965, de Reforma de la Educación Primaria, expedido con anterioridad a la finalización del curso 1975/76.</small></p>
                          <p>Plan educativo de formación básica o equivalente.</p>
                          <p>1º y 2º curso de educación secundaria obligatoria y no haber promocionado a tercero.</p>
                          <p>Primer ciclo de educación secundaria obligatoria en régimen de personas adultas y no haber promocionado al segundo ciclo.
Valoración positiva para la adscripción a este nivel tras haber realizado la prueba de valoración inicial en el acceso a la educación secundaria obligatoria para personas adultas. <small class="text-muted">Orden de 10 de agosto de 2007, por la que se regula la Eduación Secundaria Obligatoria para personas adultas.</small></p>
                        </li>
                        <li>Accedes a Nivel 2:
                          <p>Si realizaste estudios en el extranjero debes homologarlos previamente dirigiéndote a la Alta Inspección de Educación, en la Subdelegación de Gobierno de tu provincia.</p>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <h4>Salidas</h4>
                  <p>El título de Graduado en Educación Secundaria Obligatoria permitirá acceder a:</p>

                  <ul>
                    <li>Bachillerato</li>
                    <li>Formación Profesional de Grado Medio</li>
                    <li>Enseñanzas profesionales de artes plásticas y diseño de grado medio (tras superar prueba específica)</li>
                    <li>Enseñanzas deportivas de grado medio (tras superar una prueba específica o acreditar un mérito deportivo)</li>
                    <li>Prueba para la obtención directa del título de Técnico (mayores de 18 años)</li>
                  </ul>

                  <h4>Estructura</h4>
                  <p>Podrán integrar las opciones de enseñanzas académicas y aplicadas y se podrán organizar de forma modular en tres ámbitos de conocimiento y dos niveles cada uno de ellos:</p>

                  <ol type="a">
                    <li>Ámbito de comunicación, en el que se integrarán elementos del currículo recogidos en el anexo I de este real decreto, referidos a las materias Lengua Castellana y Literatura y Primera Lengua Extranjera. Además, incorporará la materia Lengua Cooficial y Literatura en aquellas Comunidades Autónomas con lengua cooficial.</li>
                    <li>Ámbito social, en el que se integrarán elementos del currículo recogidos en el anexo I de este real decreto, relacionados con la materia Geografía e Historia.</li>
                    <li>Ámbito científico-tecnológico, en el que se integrarán elementos del currículo recogidos en los anexos I y II del presente real decreto, relacionados con las materias Física y Química, Biología y Geología, Matemáticas, Matemáticas orientadas a las enseñanzas académicas, Matemáticas orientadas a las enseñanzas aplicadas, y Tecnología.</li>
                  </ol>

                  <p>Además, en todos o algunos de los tres ámbitos descritos, podrán incorporarse elementos del currículo recogidos en el anexo II de este real decreto, relacionados con las materias Educación Plástica, Visual y Audiovisual, Música, Educación Física, Ciencias Aplicadas a la Actividad Profesional, Cultura Clásica, Economía, Iniciación a la Actividad Emprendedora y Empresarial, Tecnologías de la Información y la Comunicación, así como otros aspectos que proporcionen al alumnado las destrezas necesarias para su desarrollo personal, social y profesional en el mundo actual.</p>

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

                  <h4>Tramitación</h4>
                  <p>Si deseas cursar ESO para personas adultas tendrás que solicitar admisión en primer lugar y realizar tu matrícula posteriormente.</p>

                  <p>En ambos casos puedes realizar los trámites:</p>
                  <ul>
                    <li>Mediante proceso telemático a través de Secretaría virtual, sin certificado digital (cumplimentación en línea), con certificado digital y con clave iCAT. Esta es la forma más recomendable. En este caso el procedimiento varía si quieres acceder a las enseñanzas en las modalidades presencial y semipresencial o a distancia.</li>
                    <li>Enviar tu documentación por correo postal certificado al centro docente, siempre con la solicitud y su copia sellada en correos con la fecha de envío antes de introducirla en el sobre. De esta manera puedes conservar tu copia como resguardo.</li>
                    <li>Presentar tu documentación en persona directamente en el centro docente.</li>
                    <li>Entregar tu documentación en los registros de cualquier Órgano Administrativo que pertenezca a la Administración General del Estado, a cualquiera de las Administraciones de las Comunidades Autónomas y a las Entidades Locales (esta opción es la menos recomendable por el tiempo que transcurre entre tu entrega y la recepción de tu documentación en el centro).</li>
                  </ul>

                  <h4>Matrícula: presencial y semipresencial</h4>
                  <p>Enlaces a procedimiento telemático en Secretaría virtual para formalizar la matrícula:</p>

                  <ul>
                    <li><a href="https://www.juntadeandalucia.es/educacion/secretariavirtual/acceso/4/227/" target="_blank">Matrícula en la ESO para personas adultas SIN certificado digital (cumplimentación en línea).</a></li>
                    <li><a href="https://www.juntadeandalucia.es/educacion/secretariavirtual/acceso/2/227/" target="_blank">Matrícula en la ESO para personas adultas CON certificado digital.</a></li>
                    <li><a href="https://www.juntadeandalucia.es/educacion/secretariavirtual/acceso/8/227/" target="_blank">Matrícula en la ESO para personas adultas CON clave iCAT.</a></li>
                  </ul>

                </div>

            </div>
        </div>
    </div>

    <?php include("../../../inc_pie.php"); ?>
