import React, { Fragment } from "react";
import { Container, Row, Col, Image } from "react-bootstrap";
import {
  FaFacebook,
  FaInstagram,
  FaLinkedin,
  FaTwitter,
  FaYoutube,
} from "react-icons/fa";
import { BsSendPlusFill } from "react-icons/bs";
import SchoolLogo from "./../../../assets/img/alkarama-logo.png";
import Input from "./../../UI/inputs/Input";
import Button from "./../../UI/buttons/Button";
import { Link, Form } from "react-router-dom";
import classes from "./Footer.module.css";

function Footer() {
  return (
    <Fragment>
      <Container fluid className={`p-5 ${classes.footer_container}`}>
        <Row className="align-items-center">
          <Col md={4} className="text-center mb-4 mb-md-0">
            <Image src={SchoolLogo} fluid roundedCircle />
            <h2 className={classes.footer_title}>
              Établissement AlKarama Boussaid
            </h2>
            <p className={classes.footer_text}>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris
              nec...
            </p>
            <hr className="d-md-none" />
          </Col>
          <Col md={4}>
            <Row>
              <Col>
                <h5 className={classes.footer_title}>About Us</h5>
                <Link to="#" className={classes.footer_link}>
                  <p className={classes.footer_text}>Terms</p>
                </Link>
                <Link to="#" className={classes.footer_link}>
                  <p className={classes.footer_text}>Testimonials</p>
                </Link>
              </Col>
              <Col>
                <h5 className={classes.footer_title}>Contact Us</h5>
                <Link
                  to="https://www.facebook.com/alkaramaboussaidschool"
                  target="_blank"
                  rel="noopener noreferrer"
                  className={classes.footer_link}
                >
                  <p className={classes.footer_text}>
                    <FaFacebook className={classes.social_icon} /> Facebook
                  </p>
                </Link>
                <Link
                  to="https://www.instagram.com/alkarama.boussaid1"
                  target="_blank"
                  rel="noopener noreferrer"
                  className={classes.footer_link}
                >
                  <p className={classes.footer_text}>
                    <FaInstagram className={classes.social_icon} /> Instagram
                  </p>
                </Link>
                <Link
                  to="https://www.twitter.com"
                  target="_blank"
                  rel="noopener noreferrer"
                  className={classes.footer_link}
                >
                  <p className={classes.footer_text}>
                    <FaTwitter className={classes.social_icon} /> Twitter
                  </p>
                </Link>
                <Link
                  to="https://www.linkedin.com"
                  target="_blank"
                  rel="noopener noreferrer"
                  className={classes.footer_link}
                >
                  <p className={classes.footer_text}>
                    <FaLinkedin className={classes.social_icon} /> LinkedIn
                  </p>
                </Link>
                <Link
                  to="https://www.youtube.com/@alkaramaboussaid1008"
                  target="_blank"
                  rel="noopener noreferrer"
                  className={classes.footer_link}
                >
                  <p className={classes.footer_text}>
                    <FaYoutube className={classes.social_icon} /> Youtube
                  </p>
                </Link>
              </Col>
            </Row>
            <hr className="d-md-none" />
          </Col>
          <Col md={4} className="text-left">
            <Form>
              <Input
                className={classes.newsletter_input}
                type="text"
                placeholder="Abonnez-vous à notre newsletter"
              />
              <Button
                text="Envoyer"
                type="submit"
                className={`${classes.newsletter_button}`}
                textColor="var(--alkarama-white)"
                backgroundColor="var(--alkarama-primary-color)"
                icon={<BsSendPlusFill />}
              />
            </Form>
            <hr className="d-md-none" />
          </Col>
        </Row>
        <Row className="mt-3">
          <Col className="text-center">
            <Link to="#" className={classes.footer_link}>
              <p className="text-center mt-4">
                &copy; {new Date().getFullYear()} Établissement Al Karama
                Boussaid. Tous droits réservés.
              </p>
            </Link>
          </Col>
        </Row>
      </Container>
    </Fragment>
  );
}

export default Footer;
