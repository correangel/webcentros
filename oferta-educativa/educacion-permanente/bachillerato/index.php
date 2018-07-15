<?php
require_once("../../../bootstrap.php");
require_once("../../../config.php");

if ((! isset($config['educacion_permanente']) && ! isset($config['educacion_permanente']['bachillerato'])) || (isset($config['educacion_permanente']['bachillerato']) && $config['educacion_permanente']['espa'] == false)) {
    include("../../../error404.php");
}

$pagina['titulo'] = 'Bachillerato';

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

                <div class="col-md-8">

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

                  <h4>Requisitos académicos</h4>
                  <p>Si deseas acceder a Bachillerato para personas adultas necesitas cumplir alguno de los siguientes requisitos académicos:</p>

                  <ul>
                    <li>Poseer el título de Graduado en la ESO o equivalente.</li>
                    <li>Poseer el título de Técnico de Formación Profesional o equivalente.</li>
                    <li>Si la modalidad de Bachillerato que quieres cursar es la de Arte también puedes acceder si tienes el título de Técnico de Artes Plásticas y Diseño.</li>
                  </ul>

                  <p>Si tienes estudios previos consulta las diferentes equivalencias para saber si tienes alguna materia ya superada. En este caso no tendrías que cursar dichas materias de nuevo.</p>

                  <p><a href="http://www.juntadeandalucia.es/educacion/portals/web/educacion-permanente/bachillerato/requisitos/-/libre/detalle/Fu9A/prueba-3-equivalencias-1" target="_blank">Equivalencia de las materias de Bachillerato - LOMCE</a></p>

                  <h4>Salidas</h4>
                  <p>El título de Bachiller permitirá acceder a:</p>

                  <ul>
                    <li>Ciclos Formativos de Grado Superior</li>
                    <li>Evaluación del Bachillerato para el acceso a la Universidad (EBAU)</li>
                    <li>Enseñanzas artísticas de grado superior (tras superar una prueba específica)</li>
                    <li>Prueba para la obtención directa del título de Técnico Superior (para mayores de 20 años)</li>
                  </ul>

                  <h4>Estructura</h4>
                  <p>Existen tres modalidades de Bachillerato: Artes, Ciencias y Tecnología, y Humanidades y Ciencias Sociales.</p>

                  <h5>Bachillerato de Artes</h5>

                  <h6>1º de Bachillerato</h6>
                  <div class="accordion" id="bachArtes1">
                    <div class="shadow-none card">
                      <div class="card-header" id="headingOne">
                        <h6 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Materias troncales generales
                          </button>
                        </h5>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#bachArtes1">
                        <div class="card-body">
                          <ul>
                            <li>Lengua Castellana y Literatura I</li>
                            <li>Filosofía</li>
                            <li>Primera Lengua Extranjera I</li>
                            <li>Fundamentos del Arte I</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="shadow-none card">
                      <div class="card-header" id="headingTwo">
                        <h6 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Materias troncales de opción <small>(Elegir 2)</small>
                          </button>
                        </h5>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#bachArtes1">
                        <div class="card-body">
                          <ul>
                            <li>Cultura Audiovisual I (Elección obligatoria por ser materia de continuidad en 2ª curso)</li>
                            <li>Historia del Mundo Contemporáneo / Literatura Universal. (Elegir una)</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="shadow-none card">
                      <div class="card-header" id="headingThree">
                        <h6 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Materia específica obligatoria
                          </button>
                        </h5>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#bachArtes1">
                        <div class="card-body">
                          <ul>
                            <li>Segunda Lengua Extranjera I</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="shadow-none card">
                      <div class="card-header" id="headingFour">
                        <h6 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Materias específicas de opción <small>(Elegir 2 de la opción "A" o 1 de la opción "B")</small>
                          </button>
                        </h5>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#bachArtes1">
                        <div class="card-body">
                          <p><strong>Opción A</strong></p>
                          <ul>
                            <li>Análisis Musical I</li>
                            <li>Anatomía Aplicada</li>
                            <li>Cultura Científica</li>
                            <li>Dibujo Artístico I</li>
                            <li>Lenguaje y Práctica Musical</li>
                            <li>Tecnología Industrial I</li>
                            <li>Tecnologías de la Información y Comunicación I</li>
                            <li>Volumen</li>
                            <li>Materia de libre configuración autonómica: Patrimonio Cultural y Artístico de Andalucía / Cultura Emprendedora y Empresarial.</li>
                          </ul>

                          <p><strong>Opción B</strong></p>
                          <p>Una única materia del bloque de asignaturas troncales no cursada, que podrá ser de cualquier modalidad.</p>

                        </div>
                      </div>
                    </div>
                  </div>

                  <h4>Modalidades y oferta educativa</h4>
                  <p>En Educación Permanente se oferta el Bachillerato para personas adultas. Estas enseñanzas se rigen por criterios de flexibilidad para facilitar tu incorporación al sistema educativo. Las principales diferencias respecto a la Educación Secundaria Obligatoria en régimen ordinario son:</p>
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
