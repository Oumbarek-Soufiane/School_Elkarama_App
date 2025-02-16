import React, { useState } from "react";
import { Container, Row } from "react-bootstrap";
import { Stepper, Step, StepLabel } from "@mui/material";
import StudentInformations from "./StudentInformations";
import GuardiansInformations from "./GuardiansInformations";
import SecondGuardiansInformations from "./SecondGuardiansInformations";
import OtherInformations from "./OtherInformations";
import Button from "./../UI/buttons/Button";
import { BsDatabaseFillAdd, BsArrowLeft, BsArrowRight } from "react-icons/bs";
import { newStudentAction } from "../../utils/actions";
import { useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import Swal from "sweetalert2"; // Importer SweetAlert2

const steps = [
  { label: "Information d'étudiant", component: StudentInformations },
  { label: "Information tuteurs", component: GuardiansInformations },
  { label: "Information 2ème tuteurs", component: SecondGuardiansInformations },
  { label: "Autres informations", component: OtherInformations },
];

const RegistrationForm = () => {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [activeStep, setActiveStep] = useState(0);
  const [formData, setFormData] = useState({
    student_first_name: "",
    student_last_name: "",
    student_date_of_birth: "",
    student_city_of_birth: "",
    student_country_of_birth: "",
    student_gender: "",
    student_address: "",
    student_nationality: "",
    image: null,
    guardian_first_name: "",
    guardian_last_name: "",
    guardian_cin: "",
    guardian_email: "",
    guardian_phone: "",
    guardian_address: "",
    guardian_nationality: "",
    guardian_relationship: "",
    guardian_gender: "",
    second_guardian_first_name: "",
    second_guardian_last_name: "",
    second_guardian_cin: "",
    second_guardian_email: "",
    second_guardian_phone: "",
    second_guardian_address: "",
    second_guardian_nationality: "",
    second_guardian_relationship: "",
    second_guardian_gender: "",
    level_id: "",
    section_id: "",
    needs_transportation: "",
    student_illnesses: "",
    study_troubles: "",
    study_troubles_description: "",
  });
  const [errors, setErrors] = useState({});

  const handleNext = () => {
    if (!validateFields()) {
      Swal.fire({
        icon: "warning",
        title: "Champs obligatoires non remplis",
        text: "Veuillez remplir tous les champs obligatoires avant de passer à l'étape suivante.",
        confirmButtonText: "OK",
        confirmButtonColor: "#3085d6",
      });
      return;
    }
    setActiveStep((prevActiveStep) => prevActiveStep + 1);
  };

  const handleBack = () => {
    setActiveStep((prevActiveStep) => prevActiveStep - 1);
  };

  const handleSubmit = async () => {
    const formDataToSend = new FormData();
    for (const key in formData) {
      formDataToSend.append(key, formData[key]);
    }

    const response = await newStudentAction(formDataToSend);
    if (response.error) {
      setErrors(response.error);
      console.log(response.error);
    } else {
      dispatch(setSuccessMessage(response.message));
      navigate("/admin/students/list");
    }
  };

  const updateFormData = (newData) => {
    setFormData((prevData) => ({ ...prevData, ...newData }));
  };

  // Fonction pour valider les champs requis dans l'étape actuelle
  const validateFields = () => {
    switch (activeStep) {
      case 0: // Première étape (StudentInformations)
        return (
          formData.student_first_name &&
          formData.student_last_name &&
          formData.student_date_of_birth &&
          formData.student_city_of_birth &&
          formData.student_country_of_birth &&
          formData.student_gender &&
          formData.student_address &&
          formData.student_nationality &&
          formData.image
        );
      case 1: // Deuxième étape (GuardiansInformations)
        return (
          formData.guardian_first_name &&
          formData.guardian_last_name &&
          formData.guardian_cin &&
          formData.guardian_email &&
          formData.guardian_phone &&
          formData.guardian_address &&
          formData.guardian_nationality &&
          formData.guardian_relationship &&
          formData.guardian_gender
        );
      case 2: // Troisième étape (SecondGuardiansInformations)
        return (
          formData.second_guardian_first_name &&
          formData.second_guardian_last_name &&
          formData.second_guardian_cin &&
          formData.second_guardian_email &&
          formData.second_guardian_phone &&
          formData.second_guardian_address &&
          formData.second_guardian_nationality &&
          formData.second_guardian_relationship &&
          formData.second_guardian_gender
        );
      case 3: // Quatrième étape (OtherInformations)
        return (
          formData.level_id &&
          formData.section_id &&
          formData.needs_transportation !== "" &&
          formData.student_illnesses &&
          formData.study_troubles !== "" &&
          formData.study_troubles_description
        );
      default:
        return true;
    }
  };

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
        <Row>
          {React.createElement(steps[activeStep].component, {
            formData,
            updateFormData,
            errors, // Passer les erreurs ici pour affichage
          })}
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
                onClick={handleSubmit}
                type="button"
                className=""
                backgroundColor="var(--alkarama-primary-color)"
                textColor="var(--alkarama-white)"
                size="small"
                icon={<BsDatabaseFillAdd />}
                style={{ marginLeft: "10px" }}
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
          {/*errors && (
            <div style={{ color: "red", marginTop: "20px" }}>
              {Object.keys(errors).map((key) => (
                <p key={key}>{errors[key]}</p>
              ))}
            </div>
          )*/}
        </Row>
      </Container>
    </Container>
  );
};

export default RegistrationForm;
