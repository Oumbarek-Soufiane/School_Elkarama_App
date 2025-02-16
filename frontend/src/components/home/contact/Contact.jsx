import React, { Fragment, useState } from "react";
import { Col, Container, Form, Row } from "react-bootstrap";
import { BsFillSendCheckFill } from "react-icons/bs";
import Button from "../../UI/buttons/Button";
import Input from "../../UI/inputs/Input";
import classes from "./Contact.module.css";
import { contactAction } from "../../../utils/actions/contactAction";
import { ToastContainer, toast } from "react-toastify";

function Contact() {
  const [name, setName] = useState("");
  const [firstName, setFirstName] = useState("");
  const [telephone, setTelephone] = useState("");
  const [email, setEmail] = useState("");
  const [message, setMessage] = useState("");

  const [errors, setErrors] = useState({});

  const handleSubmit = async (event) => {
    event.preventDefault();

    const formData = new FormData();
    formData.append("contact_first_name", firstName);
    formData.append("contact_last_name", name);
    formData.append("contact_telephone", telephone);
    formData.append("contact_email", email);
    formData.append("message", message);

    const response = await contactAction(formData);
    if (response.error) {
      setErrors(response.error);
      console.log(response.error);
    } else {
      toast.success("Votre message a été envoyé avec succès!");
      // Réinitialiser les champs après l'envoi du message
      setName("");
      setFirstName("");
      setTelephone("");
      setEmail("");
      setMessage("");
      setErrors({});
    }
  };

  return (
    <Fragment>
      <Container fluid className={`p-lg-5 p-sm-1 ${classes.contact_container}`}>
        <ToastContainer />
        <Container>
          <Row
            className={`${classes.titles} mb-5 align-items-center justify-content-center`}
          >
            <Col lg={12} className={`${classes.first_title} text-center mb-4`}>
              Faites-nous savoir ce que vous en pensez!
            </Col>
            <Col lg={12} className={`text-center ${classes.second_title}`}>
              Lorem ipsum dolor sit amet consectetur adipiscing elit, mattis sit
              phasellus mollis sit aliquam sit nullam.
            </Col>
          </Row>
          <Row>
            <Col lg={6}>
              <div className={`h-100 ${classes.iframe_container}`}>
                <iframe
                  className={classes.map}
                  src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12972.717179192055!2d-5.2907834!3d35.6233062!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b4509357a54df%3A0xfc770029b4f327c2!2z2YXYpNiz2LPYqSDYp9mE2YPYsdin2YXYqSDYqNmI2LPYudmK2K8gw4l0YWJsaXNzZW1lbnQgQWxrYXJhbWEgQm91c3NhaWQ!5e0!3m2!1sfr!2sma!4v1719530533398!5m2!1sfr!2sma"
                  allowFullScreen={true}
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                  title="Google Maps"
                ></iframe>
              </div>
            </Col>
            <Col lg={6}>
              <Form
                className={`my-2 p-2 p-lg-4 ${classes.contact_form}`}
                onSubmit={handleSubmit}
              >
                <Row>
                  <Col lg={6} sm={12}>
                    <Input
                      label="Prénom"
                      name="contact_first_name"
                      type="text"
                      placeholder="Brian"
                      value={firstName}
                      onChange={(e) => setFirstName(e.target.value)}
                      errorMessage={errors ? errors.contact_first_name : ""}
                    />
                  </Col>
                  <Col lg={6} sm={12}>
                    <Input
                      label="Nom"
                      name="contact_last_name"
                      type="text"
                      placeholder="Clark"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                      errorMessage={errors ? errors.contact_last_name : ""}
                    />
                  </Col>
                </Row>
                <Row>
                  <Col lg={6} sm={12}>
                    <Input
                      label="Téléphone"
                      name="contact_telephone"
                      type="text"
                      placeholder="0666666666"
                      value={telephone}
                      onChange={(e) => setTelephone(e.target.value)}
                      errorMessage={errors ? errors.contact_telephone : ""}
                    />
                  </Col>
                  <Col lg={6} sm={12}>
                    <Input
                      label="Email"
                      name="contact_email"
                      type="email"
                      placeholder="brian@email.com"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      errorMessage={errors ? errors.contact_email : ""}
                    />
                  </Col>
                </Row>
                <Row>
                  <Col lg={12} sm={12}>
                    <Input
                      label="Message"
                      textarea
                      rows={4}
                      cols={50}
                      name="message"
                      value={message}
                      onChange={(e) => setMessage(e.target.value)}
                      errorMessage={errors ? errors.message : ""}
                    />
                  </Col>
                </Row>
                <Row>
                  <Col>
                    <Button
                      text="Envoyer le message"
                      type="submit"
                      className="mt-1"
                      textColor="var(--alkarama-primary-color)"
                      backgroundColor="var(--alkarama-white)"
                      icon={<BsFillSendCheckFill />}
                      style={{ marginLeft: "10px" }}
                    />
                  </Col>
                </Row>
              </Form>
            </Col>
          </Row>
        </Container>
      </Container>
    </Fragment>
  );
}

export default Contact;
