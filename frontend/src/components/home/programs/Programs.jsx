import React, { forwardRef } from "react";
import ProgramCard from "./ProgramCard";
import { Container, Row, Col } from "react-bootstrap";
import Primary from "./../../../assets/img/primary-students.jpg";
import Elementary from "./../../../assets/img/elementary-students.jpg";
import Middle from "./../../../assets/img/middle-students.jpg";
import High from "./../../../assets/img/high-students.jpg";
import Teacher1 from "./../../../assets/img/teachers/teacher1.jpg";
import Teacher2 from "./../../../assets/img/teachers/teacher2.jpg";
import Teacher3 from "./../../../assets/img/teachers/teacher3.jpg";
import classes from "./Programs.module.css";

const detailsProgrammes = [
  {
    imgSrc: Primary,
    imgTeacherSrc: Teacher1,
    teacherName: "Oussama Taghlaoui",
    title: "Maternelle",
    description:
      "Notre programme de maternelle met l'accent sur le développement précoce des compétences sociales et cognitives, en encourageant les jeunes enfants à découvrir et à apprendre dans un environnement ludique et sécurisé.",
  },
  {
    imgSrc: Elementary,
    imgTeacherSrc: Teacher2,
    teacherName: "Oussama Taghlaoui",
    title: "Primaire",
    description:
      "Le programme primaire se concentre sur le développement des compétences fondamentales en lecture, écriture et mathématiques, tout en favorisant la curiosité et l'amour de l'apprentissage chez les élèves.",
  },
  {
    imgSrc: Middle,
    imgTeacherSrc: Teacher3,
    teacherName: "Oussama Taghlaoui",
    title: "Collège",
    description:
      "Au collège, les élèves approfondissent leurs connaissances dans une variété de matières et développent des compétences critiques et analytiques, les préparant aux exigences académiques du lycée.",
  },
  {
    imgSrc: High,
    imgTeacherSrc: Teacher2,
    teacherName: "Oussama Taghlaoui",
    title: "Lycée",
    description:
      "Le programme de lycée propose des cours avancés et spécialisés, préparant les élèves à réussir aux examens du baccalauréat marocain et à poursuivre des études supérieures ou des carrières professionnelles.",
  },
];

const Programmes = forwardRef((props, ref) => {
  return (
    <Container
      fluid
      className={`${classes.programs_container} mt-5 p-3 p-lg-5 `}
      id="programs"
      ref={ref}
    >
      <Row>
        <h1 className={`${classes.programs_title} text-center p-2`}>
          Nos Programmes
        </h1>
      </Row>
      <Container>
        <Row>
          {detailsProgrammes.map((programme, index) => (
            <Col key={index} lg={3} md={6} sm={12}>
              <ProgramCard
                imgTeacherSrc={programme.imgTeacherSrc}
                teacherName={programme.teacherName}
                imgSrc={programme.imgSrc}
                title={programme.title}
                description={programme.description}
              />
            </Col>
          ))}
        </Row>
      </Container>
    </Container>
  );
});

export default Programmes;
