import React, { useEffect, useState, Fragment } from "react";
import Input from "../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { Container, Row, Col, Table } from "react-bootstrap";
import { ToastContainer } from "react-toastify";
import { Box, Tabs, Tab } from "@mui/material";
import styles from "../student/StudentDetails.module.css";

function AssignSubjectForm({ years, marks }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [selectedYear, setSelectedYear] = useState("");
  const [selectedSemester, setSelectedSemester] = useState("");
  const [studentMarks, setStudentMarks] = useState([]);
  const [formIsValid, setFormIsValid] = useState(false);
  const [value, setValue] = useState(0);
  const [generalAverage, setGeneralAverage] = useState(0); // State for general average

  const semestres = [
    { id: 1, name: "semestre 1" },
    { id: 2, name: "semestre 2" },
  ];
  console.log(studentMarks);

  const handleChange = (event, newValue) => {
    setValue(newValue);
  };

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/assign/subject/sections");
    }
  }, [actionData, navigate, dispatch]);

  useEffect(() => {
    if (selectedYear && selectedSemester) {
      const filteredEvaluations = marks.evaluations.filter(
        (evaluation) =>
          evaluation.school_year_id === parseInt(selectedYear) &&
          evaluation.semester === parseInt(selectedSemester)
      );
      setStudentMarks(filteredEvaluations);
    }
  }, [selectedYear, selectedSemester, marks]);

  useEffect(() => {
    // Calculate general average when studentMarks change
    const data = studentMarks.reduce((acc, evaluation) => {
      const existingIndex = acc.findIndex(
        (item) => item.subject.id === evaluation.subject.id
      );

      const notes = evaluation.marks.map((mark) => mark.score);
      const coefficient = evaluation.subject.coefficient;

      if (existingIndex === -1) {
        acc.push({
          subject: evaluation.subject,
          notes,
          coefficient,
        });
      } else {
        acc[existingIndex].notes.push(...notes);
      }

      return acc;
    }, []);

    let totalWeightedAverage = 0;
    let totalCoefficients = 0;

    data.forEach((row) => {
      const average =
        row.notes.reduce((sum, note) => sum + (note || 0), 0) / row.notes.length;
      totalWeightedAverage += average * row.coefficient;
      totalCoefficients += row.coefficient;
    });

    const generalAverage = totalWeightedAverage / totalCoefficients;

    setGeneralAverage(generalAverage.toFixed(2));
  }, [studentMarks]);

  const allInputsEnabled = !!selectedYear && !!selectedSemester;

  return (
    <Fragment>
      <Container>
        <ToastContainer />
        <Form method="">
          <Row>
            <Col sm={12} md={6} lg={6}>
              <Input
                label="Annee Scolaire"
                name="school_year_id"
                type="select"
                required
                selectOptions={years.map((year) => ({
                  value: year.id,
                  label: year.name,
                }))}
                onChange={(e) => {
                  setSelectedYear(e.target.value);
                  setSelectedSemester(""); // Reset semester when year is changed
                  setFormIsValid(false);
                }}
              />
            </Col>
            <Col sm={12} md={6} lg={6}>
              <Input
                label="Semestre"
                name="semester"
                type="select"
                required
                selectOptions={semestres.map((semestre) => ({
                  value: semestre.id,
                  label: semestre.name,
                }))}
                disabled={!selectedYear}
                onChange={(e) => {
                  setSelectedSemester(e.target.value);
                  setFormIsValid(false);
                }}
              />
            </Col>
          </Row>
          <Row>
            <Col lg={12} sm={6}>
              <p>Etablissement: ALKARAMA bOUSAID</p>
              <p>
                Nom et prenom :
                {marks.student_last_name + " " + marks.student_first_name}
              </p>
              <p>Niveau : {marks.section.name}</p>
            </Col>
            <Col lg={12} sm={6}>
              <p>Classe : {marks.group.name}</p>
              <p>Nombre d'élèves</p>
            </Col>
          </Row>
          <Row className="mt-4">
            <Col>
              <Box sx={{ width: "100%" }}>
                <Tabs
                  value={value}
                  onChange={handleChange}
                  aria-label="basic tabs example"
                >
                  <Tab label="Notes de contrôles continues" />
                  <Tab label="Moyenne de notes" />
                </Tabs>
                <div className={styles.tabPanel}>
                  {value === 0 && (
                    <Box p={3}>
                      <h2>Notes de contrôles</h2>
                      <Table className="table">
                        <thead>
                          <tr>
                            <th>Matière</th>
                            <th>Note 1</th>
                            <th>Note 2</th>
                            <th>Note 3</th>
                            <th>Note 4</th>
                          </tr>
                        </thead>
                        <tbody>
                          {studentMarks
                            .reduce((acc, evaluation) => {
                              const existingIndex = acc.findIndex(
                                (item) =>
                                  item.subject.id === evaluation.subject.id
                              );

                              // Extraire la note de l'évaluation actuelle
                              const note =
                                evaluation.marks.length > 0
                                  ? evaluation.marks[0].score
                                  : undefined;

                              if (existingIndex === -1) {
                                acc.push({
                                  subject: evaluation.subject,
                                  marks: [note],
                                });
                              } else {
                                acc[existingIndex].marks.push(note);
                              }

                              return acc;
                            }, [])
                            .map((row, rowIndex) => (
                              <tr key={rowIndex}>
                                <td>{row.subject.name}</td>
                                {row.marks.map((mark, index) => (
                                  <td key={index}>
                                    {mark !== undefined ? `${mark}/20` : "-"}
                                  </td>
                                ))}
                              </tr>
                            ))}
                        </tbody>
                      </Table>
                    </Box>
                  )}
                  {value === 1 && (
                    <Box p={3}>
                      <h2>Notes</h2>
                      <Table className="table">
                        <thead>
                          <tr>
                            <th>Matière</th>
                            <th>Notes contrôles continus (Moyenne)</th>
                            <th>Coefficient</th>
                          </tr>
                        </thead>
                        <tbody>
                          {studentMarks
                            .reduce((acc, evaluation) => {
                              const existingIndex = acc.findIndex(
                                (item) =>
                                  item.subject.id === evaluation.subject.id
                              );

                              const notes = evaluation.marks.map(
                                (mark) => mark.score
                              );
                              const coefficient =
                                evaluation.subject.coefficient; // Assuming the coefficient is available in subject

                              if (existingIndex === -1) {
                                acc.push({
                                  subject: evaluation.subject,
                                  notes,
                                  coefficient,
                                });
                              } else {
                                acc[existingIndex].notes.push(...notes);
                              }

                              return acc;
                            }, [])
                            .map((row, rowIndex) => {
                              const average =
                                row.notes.reduce(
                                  (sum, note) => sum + (note || 0),
                                  0
                                ) / row.notes.length;

                              return (
                                <tr key={rowIndex}>
                                  <td>{row.subject.name}</td>
                                  <td>{average.toFixed(2)}/20</td>
                                  <td>{row.coefficient}</td>
                                </tr>
                              );
                            })}
                          {/* Ajout de la ligne pour la moyenne générale */}
                          <tr>
                            <td colSpan={2}>Moyenne générale</td>
                            <td>
                              <Input
                                type="text"
                                value={generalAverage}
                                disabled
                              />
                            </td>
                          </tr>
                        </tbody>
                      </Table>
                    </Box>
                  )}
                </div>
              </Box>
            </Col>
          </Row>
        </Form>
      </Container>
    </Fragment>
  );
}

export default AssignSubjectForm;
