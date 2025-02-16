import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import Input from "../UI/inputs/Input";

const GuardiansInformations = ({ formData, updateFormData,errors }) => {
  const handleChange = (e) => {
    updateFormData({ [e.target.name]: e.target.value });
  };

  return (
    <Container>
      <Row>
        <Col lg={6} sm={12}>
          <Input
            label="Prénom de tuteur"
            name="guardian_first_name"
            type="text"
            value={formData.guardian_first_name || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_first_name && errors.guardian_first_name}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Nom de tuteur"
            name="guardian_last_name"
            type="text"
            value={formData.guardian_last_name || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_last_name && errors.guardian_last_name}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="CIN"
            name="guardian_cin"
            type="text"
            value={formData.guardian_cin || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_cin && errors.guardian_cin}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Email"
            name="guardian_email"
            type="text"
            value={formData.guardian_email || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_email && errors.guardian_email}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Telephone"
            name="guardian_phone"
            type="text"
            value={formData.guardian_phone || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_phone && errors.guardian_phone}
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
            name="guardian_gender"
            onChange={handleChange}
            errorMessage={errors.guardian_gender && errors.guardian_gender}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Adresse"
            name="guardian_address"
            type="text"
            value={formData.guardian_address || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_address && errors.guardian_address}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Nationalité"
            name="guardian_nationality"
            type="text"
            value={formData.guardian_nationality || "marocaine"}
            onChange={handleChange}
            errorMessage={errors.guardian_nationality && errors.guardian_nationality}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Relation"
            name="guardian_relationship"
            type="text"
            value={formData.guardian_relationship || ""}
            onChange={handleChange}
            errorMessage={errors.guardian_relationship && errors.guardian_relationship}
            required
          />
        </Col>
      </Row>
    </Container>
  );
};

export default GuardiansInformations;
