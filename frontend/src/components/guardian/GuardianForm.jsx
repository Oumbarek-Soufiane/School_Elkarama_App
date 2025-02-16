import React, { useState } from "react";
import { Container, Row } from "react-bootstrap";
import { Stepper, Step, StepLabel } from "@mui/material";
import Button from "./../UI/buttons/Button";
import { BsDatabaseFillAdd, BsArrowLeft, BsArrowRight } from "react-icons/bs";
import GuardianInformations from "./GuardianInformations";
import SecondGuardianInformations from "./SecondGuardianInformations";
import { Form } from "react-router-dom";

const steps = [
  { label: "Information tuteur", component: GuardianInformations },
  { label: "Information 2ème tuteur", component: SecondGuardianInformations },
];

function GuardianForm({ method, guardian }) {
  const [activeStep, setActiveStep] = useState(0);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleNext = () => {
    setActiveStep((prevActiveStep) => prevActiveStep + 1);
  };

  const handleBack = () => {
    setActiveStep((prevActiveStep) => prevActiveStep - 1);
  };

  const handleSubmit = (event) => {
    if (!isSubmitting) {
      event.preventDefault(); 
    }
  };

  const Component = steps[activeStep].component;

  return (
    <Container fluid>
      <Stepper activeStep={activeStep} alternativeLabel>
        {steps.map((step, index) => (
          <Step key={index}>
            <StepLabel>{step.label}</StepLabel>
          </Step>
        ))}
      </Stepper>
      <Container>
        <Form method={method} onSubmit={handleSubmit}>
          <Row>
            <Component guardian={guardian} />
            <div style={{ marginTop: "20px" }}>
              <Button
                text="Retour"
                onClick={handleBack}
                type="button"
                className=""
                disabled={activeStep === 0}
                backgroundColor="var(--alkarama-tertiary-color)"
                textColor="var(--alkarama-white)"
                size="small"
                icon={<BsArrowLeft />}
              />
              {activeStep === steps.length - 1 ? (
                <Button
                  text="Soumettre"
                  type="submit"
                  className=""
                  backgroundColor="var(--alkarama-primary-color)"
                  textColor="var(--alkarama-white)"
                  size="small"
                  icon={<BsDatabaseFillAdd />}
                  style={{ marginLeft: "10px" }}
                  onClick={() => setIsSubmitting(true)}
                />
              ) : (
                <Button
                  text="Suivant"
                  onClick={handleNext}
                  type="button"
                  className=""
                  backgroundColor="var(--alkarama-primary-color)"
                  textColor="var(--alkarama-white)"
                  size="small"
                  icon={<BsArrowRight />}
                  style={{ marginLeft: "10px" }}
                />
              )}
            </div>
          </Row>
        </Form>
      </Container>
    </Container>
  );
}

export default GuardianForm;
