import React from "react";
import { Container, Row, Col, Image } from "react-bootstrap";
import classes from "./Hero.module.css";
import Button from "./../../UI/buttons/Button";
import { FaGraduationCap } from "react-icons/fa";
import SchoolImage from "./../../../assets/img/school-img.jpg";

function Hero({ programRef }) {
  const handleScrollToPrograms = () => {
    if (programRef.current) {
      programRef.current.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  };

  return (
    <Container
      className={`${classes.hero_container} d-flex justify-content-center align-items-center`}
    >
      <Row className="flex-column-reverse flex-lg-row align-items-center">
        <Col lg={6} className="text-center text-lg-start mt-4 mt-lg-0">
          <h1 className={classes.hero_title}>
            Établissement AlKarama Boussaid
          </h1>
          <h2 className={classes.hero_sub_title}>
            École Privée à Martil, Maroc
          </h2>
          <p className={classes.hero_text}>
            Établissement Al Karama Boussaid incarne l'excellence éducative à
            Martil, offrant un environnement moderne et enrichissant. Notre
            engagement envers une éducation de qualité est soutenu par un corps
            professoral compétent et dédié. Nos installations comprennent des
            salles de classe modernes, une bibliothèque complète, une mosquée,
            des espaces de loisirs, ainsi que des laboratoires technologiques et
            un accès internet sécurisé. Nous créons un environnement propice à
            l'épanouissement académique et personnel de chaque élève.
          </p>
          <Button
            className={`${classes.button} px-4 fw-bold`}
            text="Programmes"
            backgroundColor="var(--alkarama-primary-color)"
            textColor="var(--alkarama-white)"
            icon={<FaGraduationCap />}
            onClick={handleScrollToPrograms}
          />
        </Col>
        <Col
          lg={6}
          className={`d-flex justify-content-center ${classes.hero_img_container}`}
        >
          <Image src={SchoolImage} fluid rounded className={classes.hero_img} />
        </Col>
      </Row>
    </Container>
  );
}

export default Hero;
