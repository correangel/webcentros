<?php
require_once("../../bootstrap.php");
require_once("../../config.php");

$cursos = array();
$result_cursos = mysqli_query($db_con, "SELECT `nomcurso` FROM `cursos` WHERE `nomcurso` LIKE '%E.S.O.' ORDER BY `nomcurso` ASC") or die (mysqli_error($db_con));
while ($row_cursos = mysqli_fetch_array($result_cursos)) {

  $asignaturas = array();
  $result_asignaturas = mysqli_query($db_con, "SELECT DISTINCT `nombre` FROM `asignaturas` WHERE `curso` = '" . $row_cursos['nomcurso'] . "' AND `nombre` NOT LIKE '%**%' AND `abrev` NOT LIKE '%\_%' AND nombre <> 'Tutoría con Alumnos' AND nombre <> 'Refuerzo Pedagógico' ORDER BY `nombre` ASC");
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

$pagina['titulo'] = 'Educación Secundaria Obligatoria';

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

                <div class="col-md-9">

                    <p>La Educación Secundaria Obligatoria (ESO) es una etapa educativa obligatoria y gratuita que completa la educación básica. Consta de cuatro cursos académicos que se realizan ordinariamente entre los 12 y los 16 años de edad. No obstante, los alumnos tendrán derecho a permanecer en régimen ordinario cursando la enseñanza básica hasta los dieciocho años de edad.</p>

                    <p>Se organiza de acuerdo con los principios de educación común y de atención a la diversidad y presta especial atención a la orientación educativa y profesional del alumnado.</p>

                    <ul>
                      <li><a href="https://www.mecd.gob.es/educacion-mecd/dms/mecd/educacion-mecd/areas-educacion/sistema-educativo/ensenanzas/educacion-secundaria-obligatoria/Organizaci-n-ESO-Nuevo/Organización%20ESO%20Nuevo.pdf" target="_blank">Organización de la ESO.</a></li>
                    </ul>

                    <p>Desde el curso 2015-2016 comprende dos ciclos; el primero de tres cursos escolares y el segundo de uno. Este último, de carácter fundamentalmente propedéutico, puede cursarse por una de las dos siguientes opciones:</p>

                    <ul>
                      <li>Opción de enseñanzas académicas para la iniciación al Bachillerato.</li>
                      <li>Opción de enseñanzas aplicadas para la iniciación a la Formación Profesional.</li>
                    </ul>

                    <p>La Educación Secundaria Obligatoria tiene como finalidad:</p>

                    <ul>
                      <li>Lograr que todos adquieran los elementos básicos de la cultura: humanísticos, artísticos, científicos y tecnológicos.</li>
                      <li>Desarrollar y consolidar hábitos de estudio y de trabajo.</li>
                      <li>Preparar para la incorporación a estudios posteriores y para su inserción laboral.</li>
                      <li>Formar a todos para el ejercicio de sus derechos y obligaciones en la vida como ciudadanos.</li>
                    </ul>

                    <p>A partir de la completa implantación de la LOMCE la superación de la evaluación final, así como una calificación final en la etapa igual o superior a 5 puntos sobre 10 conducirá a la obtención del título de Graduado en Educación Secundaria Obligatoria.</p>

                    <p>Hasta la entrada en vigor de la normativa resultante del Pacto de Estado social y político por la educación y conforme a lo dispuesto en el <a href="http://www..es/diario_/txt.php?id=-A-2016-11733" target="_blank">Real Decreto-ley 5/2016, de 9 de diciembre</a>, de medidas urgentes para la ampliación del calendario de implantación de la Ley Orgánica 8/2013, de 9 de diciembre, para la mejora de la calidad educativa:</p>

                    <ul>
                      <li>Dicha evaluación final será considerada muestral y no tendrá efectos académicos.</li>
                      <li>Los títulos de Graduado en Educación Secundaria Obligatoria permitirán acceder indistintamente a cualquiera de las enseñanzas postobligatorias recogidas en el artículo 3.4 de la Ley Orgánica 2/2006, de 3 de mayo.</li>
                    </ul>

                    <hr>

                    <h4>Objetivos</h4>

                    <p>El <a href="http://www..es/diario_/txt.php?id=-A-2015-37" target="_blank">Real Decreto 1105/2014, de 26 de diciembre</a>, por el que se establece el currículo básico de la Educación Secundaria Obligatoria y del Bachillerato establece que la Educación Secundaria Obligatoria contribuirá a desarrollar en los alumnos y las alumnas las capacidades que les permitan:</p>

                    <ol type="a">
                      <li>Asumir responsablemente sus deberes, conocer y ejercer sus derechos en el respeto a los demás, practicar la tolerancia, la cooperación y la solidaridad entre las personas y grupos, ejercitarse en el diálogo afianzando los derechos humanos y la igualdad de trato y de oportunidades entre mujeres y hombres, como valores comunes de una sociedad plural y prepararse para el ejercicio de la ciudadanía democrática.</li>
                      <li>Desarrollar y consolidar hábitos de disciplina, estudio y trabajo individual y en equipo como condición necesaria para una realización eficaz de las tareas del aprendizaje y como medio de desarrollo personal.</li>
                      <li>Valorar y respetar la diferencia de sexos y la igualdad de derechos y oportunidades entre ellos. Rechazar la discriminación de las personas por razón de sexo o por cualquier otra condición o circunstancia personal o social. Rechazar los estereotipos que supongan discriminación entre hombres y mujeres, así como cualquier manifestación de violencia contra la mujer.</li>
                      <li>Fortalecer sus capacidades afectivas en todos los ámbitos de la personalidad y en sus relaciones con los demás, así como rechazar la violencia, los prejuicios de cualquier tipo, los comportamientos sexistas y resolver pacíficamente los conflictos.</li>
                      <li>Desarrollar destrezas básicas en la utilización de las fuentes de información para, con sentido crítico, adquirir nuevos conocimientos. Adquirir una preparación básica en el campo de las tecnologías, especialmente las de la información y la comunicación.</li>
                      <li>Concebir el conocimiento científico como un saber integrado, que se estructura en distintas disciplinas, así como conocer y aplicar los métodos para identificar los problemas en los diversos campos del conocimiento y de la experiencia.</li>
                      <li>Desarrollar el espíritu emprendedor y la confianza en sí mismo, la participación, el sentido crítico, la iniciativa personal y la capacidad para aprender a aprender, planificar, tomar decisiones y asumir responsabilidades.</li>
                      <li>Comprender y expresar con corrección, oralmente y por escrito, en la lengua castellana y, si la hubiere, en la lengua cooficial de la Comunidad Autónoma, textos y mensajes complejos, e iniciarse en el conocimiento, la lectura y el estudio de la literatura.</li>
                      <li>Comprender y expresarse en una o más lenguas extranjeras de manera apropiada.</li>
                      <li>Conocer, valorar y respetar los aspectos básicos de la cultura y la historia propias y de los demás, así como el patrimonio artístico y cultural.</li>
                      <li>Conocer y aceptar el funcionamiento del propio cuerpo y el de los otros, respetar las diferencias, afianzar los hábitos de cuidado y salud corporales e incorporar la educación física y la práctica del deporte para favorecer el desarrollo personal y social. Conocer y valorar la dimensión humana de la sexualidad en toda su diversidad. Valorar críticamente los hábitos sociales relacionados con la salud, el consumo, el cuidado de los seres vivos y el medio ambiente, contribuyendo a su conservación y mejora.</li>
                      <li>Apreciar la creación artística y comprender el lenguaje de las distintas manifestaciones artísticas, utilizando diversos medios de expresión y representación.</li>
                    </ol>

                    <hr>

                    <h4>Competencias básicas</h4>

                    <p>Las orientaciones de la Unión Europea insisten en la necesidad de la adquisición de las <strong>competencias clave</strong> por parte de la ciudadanía como condición indispensable para lograr que los individuos alcancen un pleno desarrollo personal, social y profesional que se ajuste a las demandas de un mundo globalizado y haga posible el desarrollo económico, vinculado al conocimiento.</p>

                    <p>Se conceptualizan como un "saber hacer" que se aplica a una diversidad de contextos académicos, sociales y profesionales. Para que la transferencia a distintos contextos sea posible resulta indispensable una comprensión del conocimiento presente en las competencias y la vinculación de este con las habilidades prácticas o destrezas que las integran.</p>

                    <p>Las competencias del currículo serán las siguientes:</p>

                    <ol type="a">
                      <li><a href="#" data-toggle="modal" data-target="#competenciaCcl">Comunicación lingüística.</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#competenciaCmct">Competencia matemática y competencias básicas en ciencia y tecnología.</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#competenciaCd">Competencia digital.</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#competenciaCpaa">Aprender a aprender.</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#competenciaCsc">Competencias sociales y cívicas.</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#competenciaSie">Sentido de iniciativa y espíritu emprendedor.</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#competenciaCec">Conciencia y expresiones culturales.</a></li>
                    </ol>

                    <p>Para una adquisición eficaz de las competencias y su integración efectiva en el currículo, deberán diseñarse actividades de aprendizaje integradas que permitan al alumnado avanzar hacia los resultados de aprendizaje de más de una competencia al mismo tiempo.</p>

                    <p>Se potenciará el desarrollo de las competencias Comunicación lingüística, Competencia matemática y competencias básicas en ciencia y tecnología.</p>

                    <p>Las competencias clave deben estar integradas en las áreas o materias de las propuestas curriculares, y en ellas definirse, explicitarse y desarrollarse suficientemente los resultados de aprendizaje que los alumnos y alumnas deben conseguir.</p>

                    <p>Las competencias deben desarrollarse en los ámbitos de la educación formal, no formal e informal a lo largo de la Educación Primaria, la Educación Secundaria Obligatoria y el Bachillerato, y en la educación permanente a lo largo de toda la vida.</p>

                    <hr>

                    <h4>Estructura</h4>

                    <p>La oferta educativa en Educación Secundaria Obligatoria en nuestro centro es la siguiente:</p>

                    <div class="row">

                      <?php foreach ($cursos as $curso): ?>
                      <div class="col-md-6" style="margin-bottom: 15px;">
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

                    <h4>Acceso</h4>

                    <p>El alumnado se incorporará a la Educación Secundaria Obligatoria, tras haber cursado la Educación primaria, en el año natural en el que cumpla los doce años de edad, salvo que hubiera permanecido en la Educación primaria un año académico más de los seis establecidos, en cuyo caso sería el año en que cumple los trece años de edad.</p>

                    <p>La incorporación a cualquiera de los cursos que integran la Educación Secundaria Obligatoria del alumnado procedente de sistemas educativos extranjeros que esté en edad de escolarización obligatoria se realizará atendiendo a sus circunstancias, conocimientos, edad e historial académico, para que pueda continuar con aprovechamiento su educación.</p>

                    <p>La escolarización del alumnado que presenta dificultades específicas de aprendizaje se regirá por los principios de normalización e inclusión y asegurará su no discriminación y la igualdad efectiva en el acceso y permanencia en el sistema educativo.</p>

                    <hr>

                    <h4>Admisión de alumnos</h4>

                    <p>La admisión de alumnos en centros públicos y privados concertados se regulará de tal forma que se garantice el derecho a la educación, el acceso en condiciones de igualdad y la libertad de elección de centro por padres o tutores.</p>

                    <p>Sin perjuicio de lo establecido en el <a href="http://www.boe.es/buscar/act.php?id=BOE-A-2006-7899#a84" target="_blank">artículo 84.7 de la LOE</a>, cuando no existan plazas suficientes en los centros sostenidos con fondos públicos, el proceso de admisión se regirá por los siguientes criterios prioritarios sin que ninguno de ellos tenga carácter excluyente:</p>

                    <ul>
                      <li>Existencia de hermanos matriculados en el centro o padres o tutores legales que trabajen en el mismo.</li>
                      <li>Proximidad del domicilio o del lugar de trabajo de alguno de sus padres o tutores legales.</li>
                      <li>Renta per cápita de la unidad familiar.</li>
                      <li>Condición legal de familia numerosa.</li>
                      <li>Situación de acogimiento familiar del alumno o la alumna.</li>
                      <li>Concurrencia de discapacidad en el alumno o en alguno de sus padres o hermanos.</li>
                    </ul>

                    <hr>

                    <h4>Evaluación</h4>

                    <p>La evaluación del proceso de aprendizaje del alumnado de la Educación Secundaria Obligatoria será continua, formativa e integradora.</p>

                    <p>Los resultados de la evaluación se expresarán mediante una calificación numérica, sin emplear decimales, en una escala de uno a diez, que irá acompañada de los siguientes términos: Insuficiente (IN), para calificaciones del 1 al 4), Suficiente (SU), para la calificación de 5, Bien (BI), para 6 Notable (NT), para 7 y 8, o Sobresaliente (SB), para 9 y 10. Se considerarán negativas las calificaciones inferiores a cinco.</p>

                    <p>Con la finalidad de facilitar que todos los alumnos y alumnas logren los objetivos y alcancen el adecuado grado de adquisición de las competencias correspondientes, se establecerán medidas de refuerzo, con especial atención a las necesidades específicas de apoyo educativo. La aplicación personalizada de las medidas se revisará periódicamente y, en todo caso, al finalizar el curso académico.</p>

                    <p>Se establecerán las medidas más adecuadas para que las evaluaciones se realicen en condiciones adaptadas a las necesidades del alumnado con necesidades educativas especiales. Las administraciones educativas deben establecer las condiciones para que los centros organicen las pruebas extraordinarias oportunas para facilitar a los alumnos y alumnas la recuperación de las materias con evaluación negativa.</p>

                    <p>Al final de cada uno de los cursos de Educación Secundaria Obligatoria se entregará a los padres, madres o tutores legales de cada alumno o alumna un consejo orientador, que incluirá un informe sobre el grado de logro de los objetivos y de adquisición de las competencias correspondientes, así como una propuesta a padres, madres o tutores legales o, en su caso, al alumno o alumna del itinerario más adecuado a seguir, que podrá incluir la incorporación a un programa de mejora del aprendizaje y el rendimiento o a un ciclo de Formación Profesional Básica.</p>

                    <hr>

                    <h4>Promoción</h4>

                    <p>Las decisiones sobre la promoción del alumnado de un curso a otro, dentro de la etapa, serán adoptadas por el conjunto de profesores del alumno o alumna, atendiendo al logro de los objetivos de la etapa y al grado de adquisición de las competencias correspondientes.</p>

                    <p>Los alumnos y alumnas promocionarán de curso cuando hayan superado todas las materias cursadas o tengan evaluación negativa en dos materias como máximo, y repetirán curso cuando tengan evaluación negativa en tres o más materias, o en dos materias que sean Lengua Castellana y Literatura y Matemáticas de forma simultánea. A estos efectos, sólo se computarán las materias que como mínimo el alumno o alumna debe cursar en cada uno de los bloques.</p>

                    <p>De forma excepcional, podrá autorizarse la promoción de un alumno o alumna con evaluación negativa en dos materias cuando estas sean Lengua Castellana y Literatura y Matemáticas de forma simultánea, o en tres que no incluyan al mismo tiempo a las dos anteriores, siempre que el equipo docente considere que el alumno o alumna puede seguir con éxito el curso siguiente, que tiene expectativas favorables de recuperación y que la promoción beneficiará su evolución académica, y siempre que se apliquen al alumno o alumna las medidas de atención educativa propuestas en el consejo orientador.</p>

                    <p>La repetición se considerará una medida de carácter excepcional, que solo podrá aplicarse una vez en un mismo curso, y dos veces en toda la etapa, y solo tras haber agotado las medidas ordinarias de refuerzo y apoyo. En todo caso, las repeticiones se establecerán de manera que las condiciones curriculares se adapten a las necesidades del alumno o alumna y estén orientadas a la superación de las dificultades detectadas.</p>

                    <hr>

                    <h4>Titulación</h4>

                    <p>Para obtener el título de Graduado en Educación Secundaria Obligatoria será necesario superar la evaluación final y obtener una calificación final de la etapa igual o superior a 5 puntos sobre 10. Dicha calificación final se deducirá de la siguiente ponderación:</p>

                    <ol type="a">
                      <li>con un peso del 70 %, la media de las calificaciones numéricas obtenidas en cada una de las materias cursadas en Educación Secundaria Obligatoria;</li>
                      <li>con un peso del 30 %, la nota obtenida en la evaluación final de Educación Secundaria Obligatoria.</li>
                    </ol>

                    <p>En el título deberá constar la opción u opciones por las que se realizó la evaluación final, así como la calificación final de Educación Secundaria Obligatoria.</p>

                    <hr>

                    <h4>Opciones al terminar</h4>

                    <p>El alumnado que concluya sus estudios de ESO tiene la opción de seguir estudiando, pero también puede acceder ya al mundo laboral porque con esta estapa termina la educación considerada obligatoria.</p>

                    <p>El título de graduado en educación secundaria obligatoria, con las condiciones previstas para cada enseñanza en la normativa vigente, de las cuales se informa en este <a href="https://www.mecd.gob.es/educacion-mecd/dms/mecd/educacion-mecd/areas-educacion/sistema-educativo/ensenanzas/educacion-secundaria-obligatoria/Acceso-con-Educacion-Secundaria.pdf" target="_blank">cuadro resumen</a>, permitirá acceder a:</p>

                    <ul>
                      <li>Bachillerato</li>
                      <li>Formación Profesional de grado medio</li>
                      <li>Enseñanzas profesionales de Artes Plásticas y Diseño de grado medio</li>
                      <li>Enseñanzas deportivas de grado medio</li>
                    </ul>

                    <p>En el caso de que el alumno no haya conseguido el título de ESO o no tenga estudios previos, puede acceder a:</p>

                    <ul>
                      <li>La oferta formativa de educación a lo largo de la vida</li>
                      <li>Ciclos formativos de grado medio de Formación Profesional (con prueba de acceso y 17 años)</li>
                      <li>Enseñanzas de idiomas (Cumpliendo los requisitos de edad establecidos)</li>
                      <li>Enseñanzas elementales y profesionales de Música y Danza (con prueba específica)</li>
                      <li>Ciclos formativos de grado medio de Enseñanzas profesionales de Artes Plásticas y Diseño (con prueba de acceso, prueba específica y 17 años)</li>
                      <li>Ciclos de grado medio de enseñanzas deportivas (con prueba de acceso y 17 años, y prueba específica en el caso de determinadas modalidades o especialidades)</li>
                    </ul>

                    <hr>

                    <h4>Referencia legislativa</h4>

                    <ul>
                      <li><a href="http://www.juntadeandalucia.es/educacion/portals/web/ced/normativa/-/categorias/categoria/p6w3szrJAsFL/ed-secundaria" target="_blank">Consulta normativa vigente</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal competencia CCL -->
    <div class="modal fade" id="competenciaCcl" tabindex="-1" role="dialog" aria-labelledby="competenciaCclLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaCclLabel">Competencia en comunicación lingüística</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>La <strong>competencia en comunicación lingüística (CCL)</strong> es el resultado de la acción comunicativa dentro de prácticas sociales determinadas, en las cuales el individuo actúa con otros interlocutores y a través de textos en múltiples modalidades, formatos y soportes.</p>

            <p>Precisa de la interacción de distintas destrezas, ya que se produce en múltiples modalidades de comunicación y en diferentes soportes. Desde la oralidad y la escritura hasta las formas más sofisticadas de comunicación audiovisual o mediada por la tecnología, el individuo participa de un complejo entramado de posibilidades comunicativas gracias a las cuales expande su competencia y su capacidad de interacción con otros individuos.</p>

            <p>Instrumento fundamental para la socialización y el aprovechamiento de la experiencia educativa, por ser una vía privilegiada de acceso al conocimiento dentro y fuera de la escuela.</p>

            <p>En la competencia en comunicación lingüística podemos destacar la interacción de los siguientes componentes:</p>

            <ul>
              <li>El componente lingüístico comprende diversas dimensiones: la léxica, la gramatical, la semántica, la fonológica, la ortográfica y la ortoépica, entendida esta como la articulación correcta del sonido a partir de la representación gráfica de la lengua.</li>
              <li>El componente pragmático-discursivo contempla tres dimensiones: la sociolingüística (vinculada con la adecuada producción y recepción de mensajes en diferentes contextos sociales); la pragmática (que incluye las microfunciones comunicativas y los esquemas de interacción); y la discursiva (que incluye las macrofunciones textuales y las cuestiones relacionadas con los géneros discursivos).</li>
              <li>El componente socio-cultural incluye dos dimensiones: la que se refiere al conocimiento del mundo y la dimensión intercultural.</li>
              <li>El componente estratégico permite al individuo superar las dificultades y resolver los problemas que surgen en el acto comunicativo. Incluye tanto destrezas y estrategias comunicativas para la lectura, la escritura, el habla, la escucha y la conversación, como destrezas vinculadas con el tratamiento de la información, la lectura multimodal y la producción de textos electrónicos en diferentes formatos; asimismo, también forman parte de este componente las estrategias generales de carácter cognitivo, metacognitivo y socioafectivas que el individuo utiliza para comunicarse eficazmente, aspectos fundamentales en el aprendizaje de las lenguas extranjeras.</li>
              <li>Por último, la competencia en comunicación lingüística incluye un componente personal que interviene en la interacción comunicativa en tres dimensiones: la actitud, la motivación y los rasgos de personalidad.</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal competencia CCL -->
    <div class="modal fade" id="competenciaCmct" tabindex="-1" role="dialog" aria-labelledby="competenciaCmctLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaCmctLabel">Competencia matemática y competencias básicas en ciencia y tecnología</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>La competencia matemática</strong> implica la capacidad de aplicar el razonamiento matemático y sus herramientas para describir, interpretar y predecir distintos fenómenos en su contexto.</p>

            <p>La competencia matemática requiere de conocimientos sobre los números, las medidas y las estructuras, así como de las operaciones y las representaciones matemáticas, y la comprensión de los términos y conceptos matemáticos (operaciones, números, medidas, cantidad, espacios, formas, datos, etc.)</p>

            <p>El uso de herramientas matemáticas implica una serie de destrezas que requieren la aplicación de los principios y procesos matemáticos en distintos contextos, ya sean personales, sociales, profesionales o científicos, así como para emitir juicios fundados y seguir cadenas argumentales en la realización de cálculos, el análisis de gráficos y representaciones matemáticas y la manipulación de expresiones algebraicas, incorporando los medios digitales cuando sea oportuno. Forma parte de esta destreza la creación de descripciones y explicaciones matemáticas que llevan implícitas la interpretación de resultados matemáticos y la reflexión sobre su adecuación al contexto, al igual que la determinación de si las soluciones son adecuadas y tienen sentido en la situación en que se presentan.</p>

            <p>La competencia matemática incluye una serie de actitudes y valores que se basan en el rigor, el respeto a los datos y la veracidad.</p>

            <p><strong>Las competencias básicas en ciencia y tecnología</strong> son aquellas que proporcionan un acercamiento al mundo físico y a la interacción responsable con él desde acciones, tanto individuales como colectivas, orientadas a la conservación y mejora del medio natural, decisivas para la protección y mantenimiento de la calidad de vida y el progreso de los pueblos. Estas competencias contribuyen al desarrollo del pensamiento científico, pues incluyen la aplicación de los métodos propios de la racionalidad científica y las destrezas tecnológicas, que conducen a la adquisición de conocimientos, la contrastación de ideas y la aplicación de los descubrimientos al bienestar social.</p>

            <p>Capacitan a ciudadanos responsables y respetuosos que desarrollan juicios críticos sobre los hechos científicos y tecnológicos que se suceden a lo largo de los tiempos, pasados y actuales.</p>

            <p>Para el adecuado desarrollo de las competencias en ciencia y tecnología resulta necesario abordar los saberes o conocimientos científicos relativos a la física, la química, la biología, la geología, las matemáticas y la tecnología, los cuales se derivan de conceptos, procesos y situaciones interconectadas.</p>

            <p>Se requiere igualmente el fomento de destrezas que permitan utilizar y manipular herramientas y máquinas tecnológicas, así como utilizar datos y procesos científicos para alcanzar un objetivo; es decir, identificar preguntas, resolver problemas, llegar a una conclusión o tomar decisiones basadas en pruebas y argumentos.</p>

            <p>Asimismo, estas competencias incluyen actitudes y valores relacionados con la asunción de criterios éticos asociados a la ciencia y a la tecnología, el interés por la ciencia, el apoyo a la investigación científica y la valoración del conocimiento científico; así como el sentido de la responsabilidad en relación a la conservación de los recursos naturales y a las cuestiones medioambientales y a la adopción de una actitud adecuada para lograr una vida física y mental saludable en un entorno natural y social.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal competencia CD -->
    <div class="modal fade" id="competenciaCd" tabindex="-1" role="dialog" aria-labelledby="competenciaCdLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaCdLabel">Competencia digital</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>La competencia digital (CD)</strong>es aquella que implica el uso creativo, crítico y seguro de las tecnologías de la información y la comunicación para alcanzar los objetivos relacionados con el trabajo, la empleabilidad, el aprendizaje, el uso del tiempo libre, la inclusión y participación en la sociedad.</p>

            <p>Requiere de conocimientos relacionados con el lenguaje específico básico: textual, numérico, icónico, visual, gráfico y sonoro, así como sus pautas de decodificación y transferencia. Esto conlleva el conocimiento de las principales aplicaciones informáticas. Supone también el acceso a las fuentes y el procesamiento de la información; y el conocimiento de los derechos y las libertades que asisten a las personas en el mundo digital.</p>

            <p>Igualmente precisa del desarrollo de diversas destrezas relacionadas con el acceso a la información, el procesamiento y uso para la comunicación, la creación de contenidos, la seguridad y la resolución de problemas, tanto en contextos formales como no formales e informales. La persona ha de ser capaz de hacer un uso habitual de los recursos tecnológicos disponibles con el fin de resolver los problemas reales de un modo eficiente, así como evaluar y seleccionar nuevas fuentes de información e innovaciones tecnológicas, a medida que van apareciendo, en función de su utilidad para acometer tareas u objetivos específicos.</p>

            <p>La adquisición de esta competencia requiere además actitudes y valores que permitan al usuario adaptarse a las nuevas necesidades establecidas por las tecnologías, su apropiación y adaptación a los propios fines y la capacidad de interaccionar socialmente en torno a ellas. Se trata de desarrollar una actitud activa, crítica y realista hacia las tecnologías y los medios tecnológicos, valorando sus fortalezas y debilidades y respetando principios éticos en su uso. Por otra parte, la competencia digital implica la participación y el trabajo colaborativo, así como la motivación y la curiosidad por el aprendizaje y la mejora en el uso de las tecnologías.</p>

            <p>Para el adecuado desarrollo de la competencia digital resulta necesario abordar:</p>

            <ul>
              <li>La información.</li>
              <li>La comunicación.</li>
              <li>La creación de contenidos.</li>
              <li>La seguridad.</li>
              <li>La resolución de problemas.</li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal competencia CPAA -->
    <div class="modal fade" id="competenciaCpaa" tabindex="-1" role="dialog" aria-labelledby="competenciaCpaaLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaCpaaLabel">Competencia para Aprender a aprender</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Fundamental para el aprendizaje permanente que se produce a lo largo de la vida y que tiene lugar en distintos contextos formales, no formales e informales. Supone la habilidad para iniciar, organizar y persistir en el aprendizaje.</p>

            <p>En cuanto a la organización y gestión del aprendizaje, <strong>la competencia para aprender a aprender (CPAA)</strong> requiere conocer y controlar los propios procesos de aprendizaje para ajustarlos a los tiempos y las demandas de las tareas y actividades que conducen al aprendizaje. La competencia de aprender a aprender desemboca en un aprendizaje cada vez más eficaz y autónomo.</p>

            <p>Esta competencia incluye una serie de destrezas que requieren la reflexión y la toma de conciencia de los propios procesos de aprendizaje. Así, los procesos de conocimiento se convierten en objeto del conocimiento y, además, hay que aprender a ejecutarlos adecuadamente.</p>

            <p>Aprender a aprender incluye conocimientos sobre los procesos mentales implicados en el aprendizaje (cómo se aprende). Además, esta competencia incorpora el conocimiento que posee el estudiante sobre su propio proceso de aprendizaje que se desarrolla en tres dimensiones:</p>

            <ul>
              <li>El conocimiento que tiene acerca de lo que sabe y desconoce, de lo que es capaz de aprender, de lo que le interesa, etcétera.</li>
              <li>El conocimiento de la disciplina en la que se localiza la tarea de aprendizaje y el conocimiento del contenido concreto y de las demandas de la tarea misma.</li>
              <li>El conocimiento sobre las distintas estrategias posibles para afrontar la tarea.</li>
            </ul>

            <p>Respecto a las actitudes y valores, la motivación y la confianza son cruciales para la adquisición de esta competencia. Ambas se potencian desde el planteamiento de metas realistas a corto, medio y largo plazo. Al alcanzarse las metas aumenta la percepción de auto-eficacia y la confianza, y con ello se elevan los objetivos de aprendizaje de forma progresiva. Las personas deben ser capaces de apoyarse en experiencias vitales y de aprendizaje previas con el fin de utilizar y aplicar los nuevos conocimientos y capacidades en otros contextos, como los de la vida privada y profesional, la educación y la formación.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal competencia CSC -->
    <div class="modal fade" id="competenciaCsc" tabindex="-1" role="dialog" aria-labelledby="competenciaCscLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaCscLabel">Competencias Sociales y cívicas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Conllevan la habilidad y capacidad para utilizar los conocimientos y actitudes sobre la sociedad, entendida desde las diferentes perspectivas, en su concepción dinámica, cambiante y compleja, para interpretar fenómenos y problemas sociales.</p>

            <p><strong>La competencia social</strong> se relaciona con el bienestar personal y colectivo. Exige entender el modo en que las personas pueden procurarse un estado de salud física y mental óptimo, tanto para ellas mismas como para sus familias y para su entorno social próximo, y saber cómo un estilo de vida saludable puede contribuir a ello.</p>

            <p>Implica conocimientos que permitan comprender y analizar de manera crítica los códigos de conducta y los usos generalmente aceptados en las distintas sociedades y entornos, así como sus tensiones y procesos de cambio. La misma importancia tiene conocer los conceptos básicos relativos al individuo, al grupo, a la organización del trabajo, la igualdad y la no discriminación entre hombres y mujeres y entre diferentes grupos étnicos o culturales, la sociedad y la cultura. Asimismo, es esencial comprender las dimensiones intercultural y socioeconómica de las sociedades europeas y percibir las identidades culturales y nacionales como un proceso sociocultural dinámico y cambiante en interacción con la europea, en un contexto de creciente globalización.</p>

            <p>También se requieren destrezas como la capacidad de comunicarse de una manera constructiva en distintos entornos sociales y culturales, mostrar tolerancia, expresar y comprender puntos de vista diferentes, negociar sabiendo inspirar confianza y sentir empatía. Las personas deben ser capaces de gestionar un comportamiento de respeto a las diferencias expresado de manera constructiva.</p>

            <p>Y por último se relaciona con actitudes y valores como una forma de colaboración, la seguridad en uno mismo y la integridad y honestidad. Las personas deben interesarse por el desarrollo socioeconómico y por su contribución a un mayor bienestar social de toda la población, así como la comunicación intercultural, la diversidad de valores y el respeto a las diferencias, además de estar dispuestas a superar los prejuicios y a comprometerse en este sentido.</p>

            <p><strong>La competencia cívica</strong> se basa en el conocimiento crítico de los conceptos de democracia, justicia, igualdad, ciudadanía y derechos humanos y civiles, así como de su formulación en la Constitución española, la Carta de los Derechos Fundamentales de la Unión Europea y en declaraciones internacionales, y de su aplicación por parte de diversas instituciones a escala local, regional, nacional, europea e internacional. Esto incluye el conocimiento de los acontecimientos contemporáneos, así como de los acontecimientos más destacados y de las principales tendencias en las historias nacional, europea y mundial, así como la comprensión de los procesos sociales y culturales de carácter migratorio que implican la existencia de sociedades multiculturales en el mundo globalizado.</p>

            <p>Las destrezas de esta competencia están relacionadas con la habilidad para interactuar eficazmente en el ámbito público y para manifestar solidaridad e interés por resolver los problemas que afecten al entorno escolar y a la comunidad, ya sea local o más amplia. Conlleva la reflexión crítica y creativa y la participación constructiva en las actividades de la comunidad o del ámbito mediato e inmediato, así como la toma de decisiones en los contextos local, nacional o europeo y, en particular, mediante el ejercicio del voto y de la actividad social y cívica.</p>

            <p>Las actitudes y valores inherentes a esta competencia son aquellos que se dirigen al pleno respeto de los derechos humanos y a la voluntad de participar en la toma de decisiones democráticas a todos los niveles, sea cual sea el sistema de valores adoptado. También incluye manifestar el sentido de la responsabilidad y mostrar comprensión y respeto de los valores compartidos que son necesarios para garantizar la cohesión de la comunidad, basándose en el respeto de los principios democráticos. La participación constructiva incluye también las actividades cívicas y el apoyo a la diversidad y la cohesión sociales y al desarrollo sostenible, así como la voluntad de respetar los valores y la intimidad de los demás y la recepción reflexiva y crítica de la información procedente de los medios de comunicación.</p>

            <p>Adquirir estas competencias supone ser capaz de ponerse en el lugar del otro, aceptar las diferencias, ser tolerante y respetar los valores, las creencias, las culturas y la historia personal y colectiva de los otros.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal competencia SIE -->
    <div class="modal fade" id="competenciaSie" tabindex="-1" role="dialog" aria-labelledby="competenciaSieLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaSieLabel">Sentido de la iniciativa y espíritu emprendedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>Sentido de la iniciativa y espíritu emprendedor (SIE)</strong> para transformar las ideas en actos.</p>

            <p>Entre los conocimientos que requiere esta competencia se incluye la capacidad de reconocer las oportunidades existentes para las actividades personales, profesionales y comerciales. También incluye aspectos de mayor amplitud que proporcionan el contexto en el que las personas viven y trabajan, tales como la comprensión de las líneas generales que rigen el funcionamiento de las sociedades y las organizaciones sindicales y empresariales, así como las económicas y financieras; la organización y los procesos empresariales; el diseño y la implementación de un plan (la gestión de recursos humanos y/o financieros); así como la postura ética de las organizaciones y el conocimiento de cómo estas pueden ser un impulso positivo.</p>

            <p>Asimismo, esta competencia requiere de las siguientes destrezas o habilidades esenciales: capacidad de análisis; capacidades de planificación, organización, gestión y toma de decisiones; capacidad de adaptación al cambio y resolución de problemas; comunicación, presentación, representación y negociación efectivas; habilidad para trabajar, tanto individualmente como dentro de un equipo; participación, capacidad de liderazgo y delegación; pensamiento crítico y sentido de la responsabilidad; autoconfianza, evaluación y auto-evaluación, ya que es esencial determinar los puntos fuertes y débiles de uno mismo y de un proyecto, así como evaluar y asumir riesgos cuando esté justificado (manejo de la incertidumbre y asunción y gestión del riesgo).</p>

            <p>Finalmente, requiere el desarrollo de actitudes y valores como: la predisposición a actuar de una forma creadora e imaginativa; el autoconocimiento y la autoestima; la autonomía o independencia, el interés y esfuerzo y el espíritu emprendedor. Se caracteriza por la iniciativa, la pro-actividad y la innovación, tanto en la vida privada y social como en la profesional. También está relacionada con la motivación y la determinación a la hora de cumplir los objetivos, ya sean personales o establecidos en común con otros, incluido el ámbito laboral.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal competencia SIE -->
    <div class="modal fade" id="competenciaCec" tabindex="-1" role="dialog" aria-labelledby="competenciaCecLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="competenciaCecLabel">Conciencia y expresiones culturales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p><strong>La competencia en conciencia y expresiones culturales (CEC)</strong> implica conocer, comprender, apreciar y valorar con espíritu crítico, con una actitud abierta y respetuosa, las diferentes manifestaciones culturales y artísticas, utilizarlas como fuente de enriquecimiento y disfrute personal y considerarlas como parte de la riqueza y patrimonio de los pueblos.</p>

            <p>Esta competencia incorpora también un componente expresivo referido a la propia capacidad estética y creadora y al dominio de aquellas capacidades relacionadas con los diferentes códigos artísticos y culturales, para poder utilizarlas como medio de comunicación y expresión personal. Implica igualmente manifestar interés por la participación en la vida cultural y por contribuir a la conservación del patrimonio cultural y artístico, tanto de la propia comunidad como de otras comunidades.</p>

            <p>Así pues, la competencia para la conciencia y expresión cultural requiere de conocimientos que permitan acceder a las distintas manifestaciones sobre la herencia cultural (patrimonio cultural, histórico-artístico, literario, filosófico, tecnológico, medioambiental, etcétera) a escala local, nacional y europea y su lugar en el mundo. Comprende la concreción de la cultura en diferentes autores y obras, así como en diferentes géneros y estilos, tanto de las bellas artes (música, pintura, escultura, arquitectura, cine, literatura, fotografía, teatro y danza) como de otras manifestaciones artístico-culturales de la vida cotidiana (vivienda, vestido, gastronomía, artes aplicadas, folclore, fiestas...). Incorpora asimismo el conocimiento básico de las principales técnicas, recursos y convenciones de los diferentes lenguajes artísticos y la identificación de las relaciones existentes entre esas manifestaciones y la sociedad, lo cual supone también tener conciencia de la evolución del pensamiento, las corrientes estéticas, las modas y los gustos, así como de la importancia representativa, expresiva y comunicativa de los factores estéticos en la vida cotidiana.</p>

            <p>Dichos conocimientos son necesarios para poner en funcionamiento destrezas como la aplicación de diferentes habilidades de pensamiento, perceptivas, comunicativas, de sensibilidad y sentido estético para poder comprenderlas, valorarlas, emocionarse y disfrutarlas. La expresión cultural y artística exige también desarrollar la iniciativa, la imaginación y la creatividad expresadas a través de códigos artísticos, así como la capacidad de emplear distintos materiales y técnicas en el diseño de proyectos.</p>

            <p>El desarrollo de esta competencia supone actitudes y valores personales de interés, reconocimiento y respeto por las diferentes manifestaciones artísticas y culturales, y por la conservación del patrimonio.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <?php include("../../inc_pie.php"); ?>
