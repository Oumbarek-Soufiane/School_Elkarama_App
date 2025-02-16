import React, { Fragment, useEffect, useState } from "react";
import { Container, Row, Col } from "react-bootstrap";
import { Form, useActionData, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import Input from "../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { BsDatabaseFill } from "react-icons/bs";

function UpdateStudentForm({ method, student, groups }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [studentImage, setStudentImage] = useState(null);
  const [selectedSection, setSelectedSection] = useState(
    student ? student.section_id : ""
  );

  useEffect(() => {
    if (actionData && actionData.message && !actionData.errors) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/students/list");
    }
  }, [actionData, navigate, dispatch]);

  const handleStudentImageChange = (e) => {
    setStudentImage(e.target.files[0]);
  };

  const handleSectionChange = (e) => {
    setSelectedSection(e.target.value);
  };
  const filteredGroups = groups.filter(
    (group) => group.section.id === parseInt(selectedSection)
  );

  return (
    <Fragment>
      <Container fluid>
        <Form method={method} encType="multipart/form-data">
          <Row>
            <Col lg={6}>
              <Input
                label="Section"
                name="section_id"
                type="select"
                selectOptions={
                  groups &&
                  groups.map((group) => ({
                    value: group.section.id,
                    label: group.section.name,
                  }))
                }
                value={selectedSection}
                onChange={handleSectionChange}
                errorMessage={actionData && actionData.errors?.section_id?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Groupe"
                name="group_id"
                type="select"
                selectOptions={filteredGroups.map((group) => ({
                  value: group.id,
                  label: group.name,
                }))}
                defaultValue={student ? student.group_id : ""}
                errorMessage={actionData && actionData.errors?.group_id?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="CNE"
                type="text"
                name="cne"
                defaultValue={student ? student.cne : ""}
                errorMessage={actionData && actionData.errors?.cne?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Prénom"
                type="text"
                name="student_first_name"
                defaultValue={student ? student.student_first_name : ""}
                errorMessage={
                  actionData && actionData.errors?.student_first_name?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Nom"
                type="text"
                name="student_last_name"
                defaultValue={student ? student.student_last_name : ""}
                errorMessage={
                  actionData && actionData.errors?.student_last_name?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Date de naissance"
                type="date"
                name="student_date_of_birth"
                defaultValue={student ? student.student_date_of_birth : ""}
                errorMessage={
                  actionData && actionData.errors?.student_date_of_birth?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Téléphone"
                type="text"
                name="student_phone_number"
                defaultValue={student ? student.student_phone_number : ""}
                errorMessage={
                  actionData && actionData.errors?.student_phone_number?.[0]
                }
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Adresse"
                type="text"
                name="student_address"
                defaultValue={student ? student.student_address : ""}
                errorMessage={
                  actionData && actionData.errors?.student_address?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Besoin de transport"
                selectOptions={[
                  { value: "1", label: "Oui" },
                  { value: "0", label: "Non" },
                ]}
                name="needs_transportation"
                defaultValue={student ? student.needs_transportation : ""}
                errorMessage={
                  actionData && actionData.errors?.needs_transportation?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Maladies"
                textarea
                name="student_illnesses"
                defaultValue={student ? student.student_illnesses : ""}
                errorMessage={
                  actionData && actionData.errors?.student_illnesses?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Troubles d'apprentissage"
                type="text"
                name="study_troubles"
                selectOptions={[
                  { value: "1", label: "Oui" },
                  { value: "0", label: "Non" },
                ]}
                defaultValue={student ? student.study_troubles : ""}
                errorMessage={
                  actionData && actionData.errors?.study_troubles?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Description des troubles d'apprentissage"
                textarea
                name="study_troubles_description"
                defaultValue={student ? student.study_troubles_description : ""}
                errorMessage={
                  actionData &&
                  actionData.errors?.study_troubles_description?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Image"
                type="file"
                name="image"
                onChange={handleStudentImageChange}
                errorMessage={
                  actionData && actionData.errors?.image?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Button
                text="Soumettre"
                type="submit"
                className="fw-bold float-lg-start me-2"
                backgroundColor="var(--alkarama-primary-color)"
                icon={<BsDatabaseFill />}
              />
            </Col>
          </Row>
        </Form>
      </Container>
    </Fragment>
  );
}

export default UpdateStudentForm;
