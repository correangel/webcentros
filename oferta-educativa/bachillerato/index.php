<?php
require_once("../../bootstrap.php");
require_once("../../config.php");
if (! isset($config['educacion_bachiller']) || $config['educacion_bachiller'] == 0) {
    include("../../error404.php");
}

$pagina['titulo'] = 'Bachillerato';

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

                    <p>El Bachillerato forma parte de la Educación Secundaria postobligatoria, y por lo tanto tiene carácter voluntario. Comprende dos cursos académicos, que se realizan ordinariamente entre los 16 y 18 años de edad.</p>

                    <p>El Bachillerato se desarrolla en modalidades diferentes, se organiza de modo flexible y, en su caso, en distintas vías, a fin de que pueda ofrecer una preparación especializada a los alumnos acorde con sus perspectivas e intereses de formación o permita la incorporación a la vida activa una vez finalizado el mismo.</p>

                    <ul>
                      <li><a href="https://www.mecd.gob.es/educacion-mecd/dms/mecd/educacion-mecd/areas-educacion/sistema-educativo/ensenanzas/bachillerato/02_Tabla_Organizaci-n-Bachillerato.pdf" target="_blank">Organización del Bachillerato</a></li>
                    </ul>

                    <p>Desde el curso 2015-2016 las modalidades del Bachillerato que podrán ofrecer las administraciones educativas y, en su caso, los centros docentes serán las siguientes:</p>

                    <ol type="a">
                      <li>Ciencias.</li>
                      <li>Humanidades y Ciencias Sociales.</li>
                      <li>Artes.</li>
                    </ol>

                    <p>El Bachillerato tiene como finalidad:</p>

                    <ul>
                        <li>Proporcionar a los alumnos formación, madurez intelectual y humana, conocimientos y habilidades que les permitan desarrollar funciones sociales e incorporarse a la vida activa con responsabilidad y competencia.</li>
                        <li>Capacitar a los alumnos para acceder a la educación superior.</li>
                    </ul>

                    <p>Las actividades educativas en el Bachillerato favorecerán la capacidad del alumno para aprender por sí mismo, para trabajar en equipo y para aplicar los métodos de investigación apropiados.</p>

                    <p>A partir de la completa implantación de la LOMCE, para obtener el título de bachiller será necesaria la superación de la evaluación final de Bachillerato, así como una calificación final de Bachillerato igual o superior a 5 puntos sobre 10.</p>

                    <p>En función de lo establecido en el <a href="https://www.boe.es/diario_boe/txt.php?id=BOE-A-2016-11733" target="_blank">Real Decreto-ley 5/2016, de 9 de diciembre, de medidas urgentes para la ampliación del calendario de implantación de la Ley Orgánica 8/2013, de 9 de diciembre, para la mejora de la calidad educativa</a>, y hasta la entrada en vigor de la normativa resultante del Pacto de Estado social y político por la educación, la evaluación final de bachillerato regulada por el artículo 36 bis de la Ley Orgánica 2/2006, de 3 de mayo, no será necesaria para obtener el título de Bachiller y se realizará exclusivamente para el alumnado que quiera acceder a estudios universitarios.</p>

                    <hr>

                    <h4>Objetivos</h4>

                    <p>El <a href="http://www.boe.es/diario_boe/txt.php?id=BOE-A-2015-37" target="_blank">Real Decreto 1105/2014, de 26 de diciembre</a>, por el que se establece el currículo básico de la Educación Secundaria Obligatoria y del Bachillerato establece que el Bachillerato contribuirá a desarrollar en los alumnos y las alumnas las capacidades que les permitan:</p>

                    <ol type="a">
                        <li>Ejercer la ciudadanía democrática, desde una perspectiva global, y adquirir una conciencia cívica responsable, inspirada por los valores de la Constitución española así como por los derechos humanos, que fomente la corresponsabilidad en la construcción de una sociedad justa y equitativa.</li>
                        <li>Consolidar una madurez personal y social que les permita actuar de forma responsable y autónoma y desarrollar su espíritu crítico. Prever y resolver pacíficamente los conflictos personales, familiares y sociales.</li>
                        <li>Fomentar la igualdad efectiva de derechos y oportunidades entre hombres y mujeres, analizar y valorar críticamente las desigualdades existentes e impulsar la igualdad real y la no discriminación de las personas con discapacidad.</li>
                        <li>Afianzar los hábitos de lectura, estudio y disciplina, como condiciones necesarias para el eficaz aprovechamiento del aprendizaje, y como medio de desarrollo personal.</li>
                        <li>Dominar, tanto en su expresión oral como escrita, la lengua castellana y, en su caso, la lengua cooficial de su Comunidad Autónoma.</li>
                        <li>Expresarse con fluidez y corrección en una o más lenguas extranjeras.</li>
                        <li>Utilizar con solvencia y responsabilidad las tecnologías de la información y la comunicación.</li>
                        <li>Conocer y valorar críticamente las realidades del mundo contemporáneo, sus antecedentes históricos y los principales factores de su evolución. Participar de forma solidaria en el desarrollo y mejora de su entorno social.</li>
                        <li>Acceder a los conocimientos científicos y tecnológicos fundamentales y dominar las habilidades básicas propias de la modalidad elegida.</li>
                        <li>Comprender los elementos y procedimientos fundamentales de la investigación y de los métodos científicos. Conocer y valorar de forma crítica la contribución de la ciencia y la tecnología en el cambio de las condiciones de vida, así como afianzar la sensibilidad y el respeto hacia el medio ambiente.</li>
                        <li>Afianzar el espíritu emprendedor con actitudes de creatividad, flexibilidad, iniciativa, trabajo en equipo, confianza en uno mismo y sentido crítico.</li>
                        <li>Desarrollar la sensibilidad artística y literaria, así como el criterio estético, como fuentes de formación y enriquecimiento cultural.</li>
                        <li>Utilizar la educación física y el deporte para favorecer el desarrollo personal y social.</li>
                        <li>Afianzar actitudes de respeto y prevención en el ámbito de la seguridad vial.</li>
                    </ol>

                    <hr>

                    <h4>Acceso</h4>

                    <p>Podrán acceder a los estudios del Bachillerato los estudiantes que cumplan alguno de los siguientes requisitos:</p>

                    <ul>
                        <li>Estar en posesión del título de graduado en Educación Secundaria Obligatoria *.</li>
                        <li>Estar en posesión del título de técnico Deportivo. (Acceso directo a todas las modalidades).</li>
                        <li>Estar en posesión del título de técnico de Artes Plásticas y Diseño. (Acceso directo a todas las modalidades).</li>
                    </ul>

                    <small>* Los títulos de graduado en Educación Secundaria Obligatoria expedidos hasta la entrada en vigor de la normativa resultante del Pacto de Estado social y político por la educación permitirán acceder a cualquiera de las modalidades de Bachillerato.</small>

                    <hr>

                    <h4>Admisión de alumnos</h4>

                    <p>La admisión en centros públicos y privados concertados se regulará de tal forma que se garantice el derecho a la educación, el acceso en condiciones de igualdad y la libertad de elección de centro por padres, madres o tutores.</p>

                    <p>Sin perjuicio de lo establecido en el <a href="http://www.boe.es/buscar/act.php?id=BOE-A-2006-7899#a84" target="_blank">artículo 84.7 de la LOE</a>, cuando no existan plazas suficientes en los centros sostenidos con fondos públicos, el proceso de admisión se regirá por los siguientes criterios prioritarios, sin que ninguno de ellos tenga carácter excluyente:</p>

                    <ul>
                        <li>Existencia de hermanos matriculados en el centro, o padres, madres o tutores legales que trabajen en el mismo.</li>
                        <li>Proximidad del domicilio o del lugar de trabajo de alguno de sus padres o tutores legales.</li>
                        <li>Rentas per cápita de la unidad familiar, atendiendo a las especificidades que para su cálculo se aplican a las familias numerosas. Renta per cápita de la unidad familiar y condición legal de familia numerosa.</li>
                        <li>Situación de acogimiento familiar del alumno o la alumna.</li>
                        <li>Concurrencia de discapacidad en el alumno o en alguno de sus padres, madres o hermanos.</li>
                        <li>Para las enseñanzas de Bachillerato se tendrá en cuenta, además de los criterios señalados anteriormente, el expediente académico de los estudiantes. Los centros que tengan reconocida una especialización curricular, o que participen en alguna de las acciones destinadas a fomentar la calidad de los centros docentes descritas en el artículo 122 bis, podrán reservar a criterio hasta un 20 por ciento de la puntación asignada a las solicitudes de admisión. Dicho porcentaje podrá reducirse o modularse cuando sea necesario para evitar la ruptura de criterios de equidad y de cohesión del sistema.</li>
                    </ul>

                    <hr>

                    <h4>Evaluación</h4>

                    <p>La evaluación del aprendizaje será continua y diferenciada según las distintas materias y se llevará a cabo teniendo en cuenta los diferentes elementos del currículo.</p>

                    <p>El profesorado de cada materia decidirá, al término del curso, si el alumno o alumna ha logrado los objetivos y ha alcanzado el adecuado grado de adquisición de las competencias correspondientes.</p>

                    <p>El equipo docente, constituido en cada caso por los profesores y profesoras del estudiante, coordinado por el tutor o tutora, valorará su evolución en el conjunto de las materias y su madurez académica en relación con los objetivos del Bachillerato y las competencias correspondientes.</p>

                    <p>Con el fin de facilitar a los alumnos y alumnas la recuperación de las materias con evaluación negativa, las Administraciones educativas regularán las condiciones para que los centros organicen las oportunas pruebas extraordinarias y programas individualizados en las condiciones que determinen.</p>

                    <hr>

                    <h4>Promoción</h4>

                    <p>Al finalizar el primer curso, y como consecuencia del proceso de evaluación, el profesorado de cada alumno adoptará las decisiones correspondientes sobre su promoción al segundo curso.</p>

                    <p>Se promocionará al segundo curso cuando se hayan superado todas las materias cursadas o se tenga evaluación negativa en dos materias como máximo. A estos efectos, sólo se computarán las materias que como mínimo el alumno o alumna debe cursar en cada uno de los bloques. Además, en relación con aquellos alumnos y alumnas que cursen Lengua Cooficial y Literatura, sólo se computará una materia en el bloque de asignaturas de libre configuración autonómica, con independencia de que dichos alumnos y alumnas puedan cursar más materias de dicho bloque.</p>

                    <p>Quienes promocionen al segundo curso sin haber superado todas las materias, deberán matricularse de las materias pendientes del curso anterior. Los centros organizarán las consiguientes actividades de recuperación y la evaluación de las materias pendientes.</p>

                    <hr>
                    
                    <h4>Títulación</h4>

                    <p>Para obtener el título de bachiller será necesaria la superación de la evaluación final de Bachillerato, así como una calificación final de Bachillerato igual o superior a 5 puntos sobre 10.</p>

                    <p>La calificación final de esta etapa se deducirá de la siguiente ponderación:</p>

                    <ol type="a">
                      <li>con un peso del 60 %, la media de las calificaciones numéricas obtenidas en cada una de las materias cursadas en Bachillerato.</li>
                      <li>con un peso del 40 %, la nota obtenida en la evaluación final de Bachillerato.</li>
                    </ol>

                    <p>En función de lo establecido en el <a href="https://www.boe.es/diario_boe/txt.php?id=BOE-A-2016-11733" target="_blank">Real Decreto-ley 5/2016, de 9 de diciembre, de medidas urgentes para la ampliación del calendario de implantación de la Ley Orgánica 8/2013, de 9 de diciembre, para la mejora de la calidad educativa</a>, y hasta la entrada en vigor de la normativa resultante del Pacto de Estado social y político por la educación, la evaluación final de bachillerato regulada por el artículo 36 bis de la Ley Orgánica 2/2006, de 3 de mayo, no será necesaria para obtener el título de Bachiller y se realizará exclusivamente para el alumnado que quiera acceder a estudios universitarios.</p>

                    <p>Asimismo, durante este período, los alumnos que se encuentren en posesión de un título de Técnico o de Técnico Superior de Formación Profesional o de Técnico de las Enseñanzas Profesionales de Música o de Danza podrán obtener el título de Bachiller cursando y superando las materias generales del bloque de asignaturas troncales de la modalidad de Bachillerato que el alumno elija.</p>

                    <hr>

                    <h4>Opciones al terminar</h4>

                    <p>El alumno que concluya sus estudios de Bachillerato tiene la opción de seguir estudiando e iniciar lo que se considera educación superior, pero también podría acceder al mundo laboral.</p>

                    <p>El título de Bachiller facultará para acceder a las distintas enseñanzas que constituyen la educación superior:</p>

                    <ul>
                        <li>Enseñanzas universitarias.</li>
                        <li>Enseñanzas artísticas superiores:
                        <ul>
                            <li>Estudios superiores de Música y Danza (más prueba específica)</li>
                            <li>Enseñanzas de Arte Dramático (más prueba específica)</li>
                            <li>Enseñanzas de Conservación y Restauración de Bienes Culturales (más prueba específica)</li>
                            <li>Estudios superiores de Artes Plásticas y Diseño, incluidas los de cerámica y vidrio (más prueba específica)</li>
                        </ul>
                        </li>
                        <li>Formación Profesional de grado superior</li>
                        <li>Enseñanzas profesionales de Artes Plásticas y Diseño de grado superior (más prueba de acceso)</li>
                        <li>Enseñanzas deportivas de grado superior (con título de técnico Deportivo, más prueba de acceso para determinadas especialidades)</li>
                        <li>Enseñanzas militares:
                        <ul>
                            <li>Oficiales (reconocimiento médico, prueba de inglés y prueba física)</li>
                            <li>Suboficiales (reconocimiento médico, prueba de inglés y prueba física)</li>
                        </ul>
                        </li>
                    </ul>

                    <hr>

                    <h4>Referencia legislativa</h4>

                    <ul>
                      <li><a href="http://www.juntadeandalucia.es/educacion/portals/web/ced/normativa/-/categorias/categoria/p6w3szrJAsFL/bachillerato-4" target="_blank">Consulta normativa vigente</a></li>
                    </ul>

                </div>

            </div>
        </div>
    </div>

    <?php include("../../inc_pie.php"); ?>
