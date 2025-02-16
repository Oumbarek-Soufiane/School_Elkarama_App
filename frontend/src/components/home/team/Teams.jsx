import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import TeamCard from "./TeamCard";
import Team1 from "./../../../assets/img/teams/team1.jpg";
import classes from "./Teams.module.css";

const teamMembers = [
  {
    imgSrc: Team1,
    title: "Leadership Inspirant",
    description: "Notre directeur visionnaire guide notre école avec passion et détermination, assurant un avenir brillant pour chaque élève.",
  },
  {
    imgSrc: Team1,
    title: "Expert en Mathématiques",
    description: "Avec plus de 10 ans d'expérience, notre professeur de mathématiques transforme les défis en réussites.",
  },
  {
    imgSrc: Team1,
    title: "Innovateur Scientifique",
    description: "Passionné par l'enseignement des sciences, notre professeur inspire la curiosité et l'innovation chez les étudiants.",
  },
  {
    imgSrc: Team1,
    title: "Soutien Pédagogique",
    description: "Notre conseiller pédagogique dévoué aide les enseignants et les élèves à atteindre leurs objectifs académiques.",
  },
  {
    imgSrc: Team1,
    title: "Accueillant des Admissions",
    description: "Responsable des admissions, il guide les nouvelles familles avec chaleur et expertise, assurant une transition fluide.",
  },
  {
    imgSrc: Team1,
    title: "Coordinateur d'Activités",
    description: "Organisateur dynamique, il enrichit l'expérience des élèves avec des activités extra-scolaires passionnantes et éducatives.",
  },
];

function Teams() {
  return (
    <Container className="mt-5 p-3 p-lg-5">
      <Row>
        <h1 className={`${classes.teams_title} text-center p-2`}>
          Notre Équipe Exceptionnelle
        </h1>
      </Row>
      <Row>
        {teamMembers.map((member, index) => (
          <Col key={index} lg={4} md={6} sm={12}>
            <TeamCard
              imgSrc={member.imgSrc}
              title={member.title}
              description={member.description}
            />
          </Col>
        ))}
      </Row>
    </Container>
  );
}

export default Teams;
