import React from "react";
import { Col, Container, Row } from "react-bootstrap";
import Input from "../UI/inputs/Input";

const StudentInformations = ({ formData, updateFormData, errors }) => {
  const handleChange = (e) => {
    const { name, value, files } = e.target;
    updateFormData({ [name]: files ? files[0] : value });
  };

  return (
    <Container>
      <Row>
        <Col lg={6} sm={12}>
          <Input
            label="Prénom d'étudiant"
            name="student_first_name"
            type="text"
            value={formData.student_first_name || ""}
            onChange={handleChange}
            errorMessage={
              errors.student_first_name && errors.student_first_name
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Nom d'étudiant"
            name="student_last_name"
            type="text"
            value={formData.student_last_name || ""}
            onChange={handleChange}
            errorMessage={errors.student_last_name && errors.student_last_name}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Date de naissance"
            name="student_date_of_birth"
            type="date"
            value={formData.student_date_of_birth || ""}
            onChange={handleChange}
            errorMessage={
              errors.student_date_of_birth && errors.student_date_of_birth
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Lieu de naissance"
            name="student_city_of_birth"
            type="text"
            value={formData.student_city_of_birth || ""}
            onChange={handleChange}
            errorMessage={
              errors.student_city_of_birth && errors.student_city_of_birth
            }
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Pays de naissance"
            name="student_country_of_birth"
            type="text"
            value={formData.student_country_of_birth || ""}
            onChange={handleChange}
            errorMessage={
              errors.student_country_of_birth && errors.student_country_of_birth
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
            name="student_gender"
            value={formData.student_gender || ""}
            onChange={handleChange}
            errorMessage={errors.student_gender && errors.student_gender}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Adresse"
            name="student_address"
            type="text"
            value={formData.student_address || ""}
            onChange={handleChange}
            errorMessage={errors.student_address && errors.student_address}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Nationalité"
            name="student_nationality"
            type="text"
            value={formData.student_nationality || ""}
            onChange={handleChange}
            errorMessage={
              errors.student_nationality && errors.student_nationality
            }
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Image"
            name="image"
            type="file"
            onChange={handleChange}
            errorMessage={errors.image && errors.image}
            required
          />
        </Col>
      </Row>
    </Container>
  );
};

export default StudentInformations;
