<?php
require_once("../../config.php");
if (! isset($config['educacion_bachiller']) || $config['educacion_bachiller'] == 0) {
    include("../../error404.php");
}

$pagina['titulo'] = 'Bachillerato (LOE y LOMCE)';

// SEO
//$pagina['meta']['robots'] = 0;
//$pagina['meta']['canonical'] = 0;
$pagina['meta']['meta_title'] = $pagina['titulo'];
$pagina['meta']['meta_description'] = "Información sobre ".$pagina['titulo'];
$pagina['meta']['meta_type'] = "article";
$pagina['meta']['meta_locale'] = "es_ES";

include("../../inc_menu.php");
?>

    <div class="section">
        <div class="container">

            <div class="row justify-content-md-center">

                <div class="col-md-8">

                    <p>El bachillerato forma parte de la educación secundaria postobligatoria y, por lo tanto, tiene carácter voluntario. Consta de dos cursos académicos que se realizan ordinariamente entre los 16 y 18 años de edad. Se desarrolla en modalidades diferentes, se organiza de modo flexible y, en su caso, en distintas vías.</p>
                    
                    <p>Tiene como finalidad:</p>
                    
                    <ul>
                        <li>Proporcionar a los estudiantes formación, madurez intelectual y humana, conocimientos y habilidades que les permitan desarrollar las funciones sociales e incorporarse a la vida activa con responsabilidad y competencia.</li>
                        <li>Ofrecer a los alumnos una preparación especializada, acorde con sus perspectivas e intereses de formación, que les permita acceder a la educación superior.</li>
                    </ul>
                    
                    <p>Las actividades educativas en el bachillerato favorecerán la capacidad del alumnado para aprender por sí mismo, para trabajar en equipo y para aplicar los métodos de investigación apropiados.</p>
                    
                    <p>Quienes cursen satisfactoriamente el bachillerato en cualquiera de sus modalidades recibirán el título de Bachiller, que tendrá efectos laborales y académicos.</p>
                    
                    <hr>
                    
                    <h4>Objetivos del Bachillerato</h4>
                    
                    <p>El Bachillerato contribuirá a desarrollar en los alumnos y las alumnas las capacidades que les permitan:</p>
                    
                    <ol>
                        <li>Ejercer la ciudadanía democrática.</li>
                        <li>Consolidar una madurez personal y social.</li>
                        <li>Fomentar la igualdad efectiva de derechos y oportunidades entre hombres y mujeres.</li>
                        <li>Afianzar los hábitos de lectura, estudio y disciplina.</li>
                        <li>Dominar, tanto en su expresión oral como escrita, la lengua castellana y, en su caso, la lengua cooficial de su Comunidad Autónoma.</li>
                        <li>Expresarse con fluidez y corrección en una o más lenguas extranjeras.</li>
                        <li>Utilizar con solvencia y responsabilidad las tecnologías de la información y la comunicación.</li>
                        <li>Conocer y valorar críticamente las realidades del mundo contemporáneo, así como participar de forma solidaria en el desarrollo y mejora de su entorno social.</li>
                        <li>Acceder a los conocimientos científicos y tecnológicos fundamentales y dominar las habilidades básicas propias de la modalidad elegida.</li>
                        <li>Comprender los elementos y procedimientos fundamentales de la investigación y de los métodos científicos, así como afianzar la sensibilidad y el respeto hacia el medio ambiente.</li>
                        <li>Afianzar el espíritu emprendedor.</li>
                        <li>Desarrollar la sensibilidad artística y literaria.</li>
                        <li>Utilizar la educación física y el deporte para favorecer el desarrollo personal y social.</li>
                        <li>Afianzar actitudes de respeto y prevención en el ámbito de la seguridad vial.</li>
                    </ol>
                    
                    <hr>
                    
                    <h4>Requisitos de acceso</h4>
                    
                    <p>Podrán acceder a los estudios del Bachillerato los estudiantes que cumplan alguno de los siguientes requisitos:</p>
                    
                    <ul>
                        <li>Estar en posesión del título de Graduado en Educación Secundaria Obligatoria.<br>(Acceso directo a todas las modalidades)</li>
                        <li>Estar en posesión del título de Técnico de formación profesional.<br>(Acceso directo a todas las modalidades)</li>
                        <li>Estar en posesión del título de Técnico Deportivo.<br>(Acceso directo a todas las modalidades)</li>
                        <li>Estar en posesión del título de Técnico de Artes Plásticas y Diseño.<br>(Acceso directo a todas las modalidades)</li>
                    </ul>
                    
                    <hr>
                    
                    <h4>Admisión de alumnos</h4>
                    
                    <p>La admisión en centros públicos y privados concertados se regulará de tal forma que se garantice el derecho a la educación, el acceso en condiciones de igualdad y la libertad de elección de centro por padres o tutores.</p>
                    
                    <p>Cuando no existan plazas suficientes en los centros sostenidos con fondos públicos, el proceso de admisión se regirá por los siguientes criterios prioritarios sin que ninguno de ellos tenga carácter excluyente:</p>
                    
                    <ul>
                        <li>Existencia de hermanos matriculados en el centro o padres o tutores legales que trabajen en el mismo.</li>
                        <li>Proximidad del domicilio o del lugar de trabajo de alguno de sus padres o tutores legales.</li>
                        <li>Rentas anuales de la unidad familiar, atendiendo a las especificidades que para su cálculo se aplican a las familias numerosas.</li>
                        <li>Concurrencia de discapacidad en el alumno o en alguno de sus padres o hermanos.</li>
                        <li>Para las enseñanzas de bachillerato se tendrá en cuenta, además de los criterios señalados anteriormente, el expediente académico de los estudiantes.</li>
                    </ul>
                    
                    <hr>
                    
                    <h4>Organización del bachillerato</h4>
                    
                    <h5>Modalidades</h5>
                    
                    <ul>
                        <li>Modalidad de Ciencias y Tecnología</li>
                        <li>Modalidad de Humanidades y Ciencias Sociales</li>
                    </ul>
                    
                    <h5>Materias</h5>
                    
                    <ul>
                        <li><strong>Materias comunes: son obligatorias</strong> independientemente de la modalidad elegida. Tienen como finalidad profundizar en la formación general del alumnado, aumentar su madurez intelectual y humana, y profundizar en aquellas competencias que tienen un carácter más transversal y favorecen seguir aprendiendo.</li>
                        <li><strong>Materias de modalidad:</strong> tienen como finalidad proporcionar una <strong>formación de carácter específico, vinculada a la modalidad elegida</strong>, que oriente en un ámbito de conocimiento amplio, desarrolle aquellas competencias con una mayor relación con el mismo, prepare para una variedad de estudios posteriores y favorezca la inserción en un determinado campo laboral. Los estudiantes deberán cursar, en el conjunto de los dos cursos del bachillerato, un mínimo de seis materias de modalidad, de las cuales al menos cinco deberán ser de la modalidad elegida.</li>
                        <li><strong>Materias optativas:</strong> tienen como finalidad completar la <strong>formación del alumnado, profundizando en aspectos propios de la modalidad elegida</strong>, o ampliando las perspectivas de la propia formación general. Los estudiantes podrán elegir también como materia optativa al menos una materia de modalidad. La oferta de materias optativas deberá incluir una Segunda lengua extranjera y Tecnologías de la información y la comunicación.</li>
                    </ul>
                    
                    <hr>
                    
                    <h4>Evaluación, promoción y titulación del Bachillerato</h4>
                    
                    <h5>Evaluación</h5>
                                
                    <p>La evaluación del aprendizaje será continua y diferenciada según las distintas materias y se llevará a cabo teniendo en cuenta los diferentes elementos del currículo.</p> 
                    
                    <p>El alumnado podrá realizar una prueba extraordinaria de las materias no superadas, en las fechas que determinen las Administraciones educativas.</p>
                    
                    <p>El profesor de cada materia decidirá, al término del curso, si el alumno o la alumna ha superado los objetivos de la misma, tomando como referente fundamental los criterios de evaluación.</p>
                    
                    <p>El equipo docente, constituido por los profesores de cada alumno o alumna coordinados por el profesor tutor, valorará su evolución en el conjunto de las materias y su madurez académica en relación con los objetivos del bachillerato así como, al final de la etapa, sus posibilidades de progreso en estudios posteriores.</p>
                    
                    <h5>Promoción</h5>
                                
                    <p>Al finalizar el primer curso, y como consecuencia del proceso de evaluación, el profesorado de cada alumno adoptará las decisiones correspondientes sobre su promoción al segundo curso.</p> 
                    
                    <p>Se promocionará al segundo curso cuando se hayan superado todas las materias cursadas o se tenga evaluación negativa en dos materias como máximo.</p>
                    
                    <p>Quienes promocionen al segundo curso sin haber superado todas las materias, deberán matricularse de las materias pendientes del curso anterior. Los centros organizarán las consiguientes actividades de recuperación y la evaluación de las materias pendientes</p>
                    
                    <h5>Títulación</h5>
                                
                    <p>Quienes cursen satisfactoriamente el bachillerato en cualquiera de sus modalidades recibirán el <strong>Título de Bachiller</strong>, que tendrá efectos laborales y académicos.</p> 
                    
                    <p>Para obtener el título de Bachiller será necesaria la evaluación positiva en todas las materias de los dos cursos de bachillerato.</p>
                    
                    <p>El alumnado que finalice las enseñanzas profesionales de música y danza, obtendrá el título de Bachiller si supera las materias comunes del bachillerato.</p>
                    
                    <hr>
                    
                    <h4>Opciones al terminar el bachillerato</h4>
                    
                    <p>El alumno que concluya sus estudios de Bachillerato tiene la opción de seguir estudiando e iniciar lo que se considera educación superior, pero también podría acceder al mundo laboral.</p>
                    
                    <h5>Opciones educativas</h5>
                    
                    <p>El título de Bachiller facultará para acceder a las distintas enseñanzas que constituyen la educación superior:</p>
                    
                    <ul>
                        <li>Enseñanza universitaria (más prueba de acceso a la universidad).</li>
                        <li>Enseñanzas artísticas superiores:
                        <ul>
                            <li>Estudios superiores de música y danza (más prueba específica).</li>
                            <li>Enseñanzas de arte dramático (más prueba específica).</li>
                            <li>Enseñanzas de conservación y restauración de bienes culturales (más prueba específica).</li>
                            <li>Estudios superiores de artes plásticas y diseño, incluidas los de cerámica y vidrio (más prueba específica).</li>
                        </ul>
                        </li>
                        <li>Formación profesional de grado superior.</li>
                        <li>Enseñanzas profesionales de artes plásticas y diseño de grado superior (más prueba de acceso).</li>
                        <li>Enseñanzas deportivas de grado superior (con título de Técnico deportivo, más prueba de acceso para determinadas especialidades).</li>
                        <li>Enseñanzas militares:
                        <ul>
                            <li>Oficiales (más prueba de acceso a la universidad y reconocimiento médico, prueba de inglés y prueba física)</li>
                            <li>Suboficiales (reconocimiento médico, prueba de inglés y prueba física)</li>
                        </ul>
                        </li>
                    </ul>
          
                </div>
                
            </div>
        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>