import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import Input from "../UI/inputs/Input";

const SecondGuardiansInformations = ({ formData, updateFormData, errors }) => {
  const handleChange = (e) => {
    updateFormData({ [e.target.name]: e.target.value });
  };

  return (
    <Container>
      <Row>
        <Col lg={6} sm={12}>
          <Input
            label="Prénom de deuxième tuteur"
            name="second_guardian_first_name"
            type="text"
            value={formData.second_guardian_first_name || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_first_name &&
              errors.second_guardian_first_name
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Nom de deuxième tuteur"
            name="second_guardian_last_name"
            type="text"
            value={formData.second_guardian_last_name || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_last_name &&
              errors.second_guardian_last_name
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="CIN"
            name="second_guardian_cin"
            type="text"
            value={formData.second_guardian_cin || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_cin && errors.second_guardian_cin
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Email"
            name="second_guardian_email"
            type="text"
            value={formData.second_guardian_email || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_email && errors.second_guardian_email
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Telephone"
            name="second_guardian_phone"
            type="text"
            value={formData.second_guardian_phone || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_phone && errors.second_guardian_phone
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Genre"
            selectOptions={[
              { value: "male", label: "Male" },
              { value: "female", label: "Femelle" },
            ]}
            name="second_guardian_gender"
            value={formData.second_guardian_gender || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_gender && errors.second_guardian_gender
            }
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Adresse"
            name="second_guardian_address"
            type="text"
            value={formData.second_guardian_address || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_address && errors.second_guardian_address
            }
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Nationalité"
            name="second_guardian_nationality"
            type="text"
            value={formData.second_guardian_nationality || "marocaine"}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_nationality &&
              errors.second_guardian_nationality
            }
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Relation"
            name="second_guardian_relationship"
            type="text"
            value={formData.second_guardian_relationship || ""}
            onChange={handleChange}
            errorMessage={
              errors.second_guardian_relationship &&
              errors.second_guardian_relationship
            }
            required
          />
        </Col>
      </Row>
    </Container>
  );
};

export default SecondGuardiansInformations;
