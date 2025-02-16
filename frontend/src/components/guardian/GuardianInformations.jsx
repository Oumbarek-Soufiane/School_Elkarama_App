import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import Input from "../UI/inputs/Input";

const GuardianInformations = ({ guardian }) => {
  return (
    <Container>
      <Row>
        <Col lg={6} sm={12}>
          <Input
            label="Prénom de tuteur"
            name="guardian_first_name"
            type="text"
            defaultValue={guardian.guardian_first_name || ""}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Nom de tuteur"
            name="guardian_last_name"
            type="text"
            defaultValue={guardian.guardian_last_name || ""}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="CIN"
            name="guardian_cin"
            type="text"
            defaultValue={guardian.guardian_cin || ""}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Email"
            name="guardian_email"
            type="text"
            defaultValue={guardian.guardian_email || ""}
            required
          />
        </Col>
        <Col lg={6} sm={12}>
          <Input
            label="Telephone"
            name="guardian_phone"
            type="text"
            defaultValue={guardian.guardian_phone || ""}
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
            defaultValue={guardian.guardian_gender || ""}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Adresse"
            name="guardian_address"
            type="text"
            defaultValue={guardian.guardian_address || ""}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Nationalité"
            name="guardian_nationality"
            type="text"
            defaultValue={guardian.guardian_nationality || ""}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Relation"
            name="guardian_relationship"
            type="text"
            defaultValue={guardian.guardian_relationship || ""}
            required
          />
        </Col>
      </Row>
    </Container>
  );
};

export default GuardianInformations;
