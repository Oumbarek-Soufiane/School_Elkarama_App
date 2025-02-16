import React, { useEffect, useState, Fragment } from "react";
import Input from "../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Container, Row, Col } from "react-bootstrap";

function TeacherForm({ method, subjects, teacher }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [teacherImage, setTeacherImage] = useState(null);

  useEffect(() => {
    if (actionData && actionData.message && !actionData.errors) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/teachers/list");
    }
  }, [actionData, navigate, dispatch]);

  const handleTeacherImageChange = (e) => {
    setTeacherImage(e.target.files[0]);
  };

  return (
    <Fragment>
      <Form method={method} encType="multipart/form-data">
        <Container>
          <Row>
            <Col lg={6}>
              <Input
                label="CIN"
                type="text"
                name="teacher_cin"
                defaultValue={teacher ? teacher.teacher_cin : ""}
                errorMessage={actionData && actionData.errors?.teacher_cin?.[0]}
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Prénom"
                type="text"
                name="teacher_first_name"
                defaultValue={teacher ? teacher.teacher_first_name : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_first_name?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Nom"
                type="text"
                name="teacher_last_name"
                defaultValue={teacher ? teacher.teacher_last_name : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_last_name?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Date de naissance"
                type="date"
                name="teacher_date_of_birth"
                defaultValue={teacher ? teacher.teacher_date_of_birth : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_date_of_birth?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Lieu de naissance"
                type="text"
                name="teacher_place_of_birth"
                defaultValue={teacher ? teacher.teacher_place_of_birth : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_place_of_birth?.[0]
                }
                required
              />
            </Col>
            <Col lg={6}>
              <Input
                label="Genre"
                selectOptions={[
                  { value: "male", label: "Male" },
                  { value: "female", label: "Femelle" },
                ]}
                name="teacher_gender"
                defaultValue={teacher ? teacher.teacher_gender : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_gender?.[0]
                }
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Adresse"
                type="text"
                name="teacher_address"
                defaultValue={teacher ? teacher.teacher_address : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_address?.[0]
                }
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Email"
                type="email"
                name="teacher_email"
                defaultValue={teacher ? teacher.teacher_email : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_email?.[0]
                }
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Téléphone"
                type="text"
                name="teacher_phone_number"
                defaultValue={teacher ? teacher.teacher_phone_number : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_phone_number?.[0]
                }
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Nationalité"
                type="text"
                name="teacher_nationality"
                defaultValue={teacher ? teacher.teacher_nationality : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_nationality?.[0]
                }
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Diplôme"
                type="text"
                name="teacher_diploma"
                defaultValue={teacher ? teacher.teacher_diploma : ""}
                errorMessage={
                  actionData && actionData.errors?.teacher_diploma?.[0]
                }
                required
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Image"
                type="file"
                name="teacher_image"
                onChange={handleTeacherImageChange}
                errorMessage={
                  actionData && actionData.errors?.teacher_image?.[0]
                }
              />
            </Col>
            <Col lg={12}>
              <Input
                label="Matières"
                name="subjects[]"
                type="select"
                selectOptions={
                  subjects &&
                  subjects.map((subject) => ({
                    value: subject.id,
                    label: subject.name,
                  }))
                }
                multiple
                defaultValue={
                  teacher && teacher.subjects
                    ? teacher.subjects.map((subject) => subject.id)
                    : []
                }
                errorMessage={actionData && actionData.errors?.subjects?.[0]}
                required
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
        </Container>
      </Form>
    </Fragment>
  );
}

export default TeacherForm;
