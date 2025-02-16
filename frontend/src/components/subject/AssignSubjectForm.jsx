import React, { useEffect, useState, Fragment } from "react";
import Input from "../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Container, Row, Col, Table } from "react-bootstrap";
import axios from "axios";
import { getAuthToken } from "../../utils/loaders";
import { AppURL } from "../../apis/AppURL";
import { ToastContainer } from "react-toastify";

function AssignSubjectForm({ method, levels, subjects }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const [selectedLevel, setSelectedLevel] = useState("");
  const [selectedSection, setSelectedSection] = useState("");
  const [sections, setSections] = useState([]);
  const [sectionSubjects, setSectionSubjects] = useState([]);
  const [formIsValid, setFormIsValid] = useState(false);

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/assign/subject/sections");
    }
  }, [actionData, navigate, dispatch]);

  useEffect(() => {
    if (selectedLevel) {
      const level = levels.find(
        (level) => level.id === parseInt(selectedLevel)
      );
      setSections(level ? level.sections : []);
    } else {
      setSections([]);
    }
  }, [selectedLevel, levels]);

  useEffect(() => {
    if (selectedSection) {
      const authToken = getAuthToken();
      axios
        .get(AppURL.getSectionSubjects(selectedSection), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        })
        .then((response) => {
          setSectionSubjects(response.data.sectionSubjects);
        })
        .catch((error) => {
          console.error("Error fetching section subjects:", error);
        });
    } else {
      setSectionSubjects([]);
    }
  }, [selectedSection]);

  const checkFormValidity = () => {
    const isValid = subjects.some((subject) => {
      const existingSubject = sectionSubjects.find(
        (ss) => ss.subject_id === subject.id
      );
      const coefficientValue = document.getElementsByName(
        `coefficient_${subject.id}`
      )[0].value;
      const hoursValue = document.getElementsByName(`hours_${subject.id}`)[0]
        .value;
      return (
        document.getElementsByName(`assign_subject_${subject.id}`)[0].checked &&
        (coefficientValue !== "" || hoursValue !== "")
      );
    });
    setFormIsValid(isValid);
  };

  const handleInputChange = () => {
    checkFormValidity();
  };

  const allInputsEnabled = !!selectedSection;

  return (
    <Fragment>
      <Container>
        <ToastContainer />
        <Form method={method}>
          <Row>
            <Col sm={12} md={6} lg={6}>
              <Input
                label="Niveau"
                name="level_id"
                type="select"
                required
                selectOptions={levels.map((level) => ({
                  value: level.id,
                  label: level.name,
                }))}
                onChange={(e) => {
                  setSelectedLevel(e.target.value);
                  setFormIsValid(false);
                }}
              />
            </Col>
            <Col sm={12} md={6} lg={6}>
              <Input
                label="Section"
                name="section_id"
                type="select"
                required
                selectOptions={sections.map((section) => ({
                  value: section.id,
                  label: section.name,
                }))}
                disabled={!selectedLevel}
                onChange={(e) => {
                  setSelectedSection(e.target.value);
                  setFormIsValid(false);
                }}
              />
            </Col>
          </Row>
          <Row className="mt-4">
            <Col>
              <Table striped bordered hover>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nom de la matière</th>
                    <th>Coefficient</th>
                    <th>Nombre d'heures</th>
                    <th>Affecter</th>
                  </tr>
                </thead>
                <tbody>
                  {subjects &&
                    subjects.map((subject, index) => {
                      const existingSubject = sectionSubjects.find(
                        (ss) => ss.subject_id === subject.id
                      );
                      const coefficientValue = existingSubject
                        ? existingSubject.coefficient
                        : "";
                      const hoursValue = existingSubject
                        ? existingSubject.hours_per_week
                        : "";
                      return (
                        <tr key={subject.id}>
                          <td>{index + 1}</td>
                          <td>{subject.name}</td>
                          <td>
                            <input
                              className="form-control form-control-sm"
                              name={`coefficient_${subject.id}`}
                              type="number"
                              min="0"
                              step="0.1"
                              defaultValue={coefficientValue}
                              onChange={handleInputChange}
                              disabled={!allInputsEnabled}
                            />
                          </td>
                          <td>
                            <input
                              className="form-control form-control-sm"
                              name={`hours_${subject.id}`}
                              type="number"
                              min="0"
                              step="0.1"
                              defaultValue={hoursValue}
                              onChange={handleInputChange}
                              disabled={!allInputsEnabled}
                            />
                          </td>
                          <td>
                            <input
                              className="form-check-input form-check-input-sm"
                              name={`assign_subject_${subject.id}`}
                              type="checkbox"
                              defaultChecked={!!existingSubject}
                              onChange={handleInputChange}
                              disabled={!allInputsEnabled}
                            />
                          </td>
                        </tr>
                      );
                    })}
                </tbody>
              </Table>
            </Col>
          </Row>
          <Button
            text="Soumettre"
            type="submit"
            className="fw-bold float-lg-start me-2"
            backgroundColor="var(--alkarama-primary-color)"
            icon={<BsDatabaseFill />}
            disabled={!formIsValid || !allInputsEnabled}
          />
        </Form>
      </Container>
    </Fragment>
  );
}

export default AssignSubjectForm;
