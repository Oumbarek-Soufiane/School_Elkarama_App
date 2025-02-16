import React, { useState } from "react";
import { Container, Row, Col, Button as BoostrapButton } from "react-bootstrap";
import { Tabs, Tab, Box } from "@mui/material";
import styles from "./StudentDetails.module.css";
import ThinCard from "../UI/cards/ThinCard";
import Input from "./../UI/inputs/Input";
import { BsDatabaseFill } from "react-icons/bs";
import Button from "../UI/buttons/Button";
import { BASE_URL } from "./../../apis/BaseURL";
import NoStudentImage from "./../../assets/img/no-image.png";
import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../../utils/loaders";
import { ToastContainer, toast } from "react-toastify";
import { Link } from "react-router-dom";
import { FaUserEdit } from "react-icons/fa";

function StudentDetails({ student }) {
  const [errors, setErrors] = useState(null);
  const token = getAuthToken();
  const [value, setValue] = React.useState(0);

  const handleChange = (event, newValue) => {
    setValue(newValue);
  };

  const handleResetPassword = async (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);
    const studentId = student.id;
    formData.set("student_email", student.student_email);
    try {
      const response = await axios.post(
        AppURL.resetpassword(studentId),
        formData,
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      if (response.data.errors) {
        setErrors(response.data.errors);
      } else {
        toast.success(response.data.message);
        setErrors(null);
      }
    } catch (error) {
      if (error.response && error.response.data && error.response.data.errors) {
        setErrors(error.response.data.errors);
      } else {
        alert("Erreur lors de la réinitialisation");
        console.error(error);
      }
    }
  };

  return (
    <Container fluid className={`mt-4`}>
      <ToastContainer />
      <Row>
        <Col xs={12} lg={4} className={styles.leftColumn}>
          <ThinCard>
            <div className="d-flex justify-content-center my-2">
              <div className="border rounded-circle p-2">
                <img
                  src={
                    student.image
                      ? `${BASE_URL}/storage/${student.image}`
                      : NoStudentImage
                  }
                  alt=""
                  className="rounded-circle"
                  style={{ width: "100px", height: "100px" }}
                />
              </div>
            </div>
            <div className="mb-2">
              <strong>Nom: </strong> {student.student_last_name}
            </div>
            <div className="mb-2">
              <strong>Prénom: </strong> {student.student_first_name}
            </div>
            <div className="mb-2">
              <strong>CNE: </strong> {student.cne}
            </div>
            <Link to={`/admin/students/${student.id}/edit`}>
              <Button
                text="Modifier etudiant"
                type="button"
                className=""
                backgroundColor="var(--alkarama-primary-color)"
                textColor="var(--alkarama-white)"
                size="small"
                icon={<FaUserEdit />}
                style={{ marginLeft: "10px" }}
              />
            </Link>
            <BoostrapButton className="d-none" variant="secondary">
              Télécharger une attestation
            </BoostrapButton>
          </ThinCard>
        </Col>
        <Col xs={12} lg={8} className={styles.rightColumn}>
          <Box sx={{ width: "100%" }}>
            <Tabs
              value={value}
              onChange={handleChange}
              aria-label="basic tabs example"
            >
              <Tab label="Informations Personnelles" />
              <Tab label="Notes" />
              <Tab label="Absences" />
              <Tab label="Changer mot de passe" />
            </Tabs>
            <div className={styles.tabPanel}>
              {value === 0 && (
                <Box p={3}>
                  <h2>Informations Personnelles</h2>
                  <table className="table">
                    <tbody>
                      <tr>
                        <td>CNE</td>
                        <td>{student.cne}</td>
                      </tr>
                      <tr>
                        <td>Nom</td>
                        <td>{student.student_last_name}</td>
                      </tr>
                      <tr>
                        <td>Prénom</td>
                        <td>{student.student_first_name}</td>
                      </tr>
                      <tr>
                        <td>Classe</td>
                        <td>
                          {student.section
                            ? student.section.name
                            : "N'a pas de classe"}
                        </td>
                      </tr>
                      <tr>
                        <td>Groupe</td>
                        <td>
                          {student.group
                            ? student.group.name
                            : "N'a pas de groupe"}
                        </td>
                      </tr>
                      <tr>
                        <td>Date de naissance</td>
                        <td>{student.student_date_of_birth}</td>
                      </tr>
                      <tr>
                        <td>Ville de naissance</td>
                        <td>{student.student_city_of_birth}</td>
                      </tr>
                      <tr>
                        <td>Pays de naissance</td>
                        <td>{student.student_country_of_birth}</td>
                      </tr>
                      <tr>
                        <td>Genre</td>
                        <td>{student.student_gender}</td>
                      </tr>
                      <tr>
                        <td>Adresse</td>
                        <td>{student.student_address}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{student.student_email}</td>
                      </tr>
                      <tr>
                        <td>Numéro de téléphone</td>
                        <td>{student.student_phone_number}</td>
                      </tr>
                      <tr>
                        <td>Nationalité</td>
                        <td>{student.student_nationality}</td>
                      </tr>
                      <tr>
                        <td>Besoin de transport</td>
                        <td>{student.needs_transportation ? "OUI" : "NON"}</td>
                      </tr>
                      <tr>
                        <td>Maladies</td>
                        <td>{student.student_illnesses}</td>
                      </tr>
                      <tr>
                        <td>Difficultés d'étude</td>
                        <td>{student.study_troubles ? "OUI" : "NON"}</td>
                      </tr>
                      <tr>
                        <td>Description des difficultés d'étude</td>
                        <td>{student.study_troubles_description}</td>
                      </tr>
                    </tbody>
                  </table>
                </Box>
              )}
              {value === 1 && (
                <Box p={3}>
                  <h2>Notes</h2>
                  <table className="table">
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
                      <tr>
                        <td>Mathématiques</td>
                        <td>18/20</td>
                      </tr>
                      <tr>
                        <td>Physique</td>
                        <td>15/20</td>
                      </tr>
                      <tr>
                        <td>Chimie</td>
                        <td>17/20</td>
                      </tr>
                    </tbody>
                  </table>
                </Box>
              )}
              {value === 2 && (
                <Box p={3}>
                  <h2>Absences</h2>
                  <table className="table">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Matière</th>
                        <th>Motif</th>
                      </tr>
                    </thead>
                    <tbody>
                      {student.absences.length > 0 ? (
                        student.absences
                          .filter((absence) => !absence.is_present)
                          .map((absence) => (
                            <tr key={absence.id}>
                              <td>
                                {new Date(absence.date).toLocaleDateString()}
                              </td>
                              <td>
                                {absence.subject
                                  ? absence.subject.name
                                  : "Indisponible"}
                              </td>
                              <td>
                                {absence.reason_if_absent ?? "Indisponible"}
                              </td>
                            </tr>
                          ))
                      ) : (
                        <tr>
                          <td colSpan="3">Aucune absence enregistrée</td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </Box>
              )}
              {value === 3 && (
                <Box p={3}>
                  <h2>Changemet de mot de passe</h2>
                  <form onSubmit={handleResetPassword} method="POST">
                    {errors && (
                      <div className="alert alert-danger">
                        {Object.keys(errors).map((key) => (
                          <div key={key}>{errors[key][0]}</div>
                        ))}
                      </div>
                    )}
                    <Input
                      label="Email"
                      type="email"
                      name="student_email"
                      defaultValue={student.student_email}
                      readOnly
                    />
                    <Input
                      label="Mot de passe"
                      type="password"
                      name="student_password"
                      required
                    />
                    <Button
                      text="Soumettre"
                      type="submit"
                      className="fw-bold float-lg-start me-2"
                      backgroundColor="var(--alkarama-primary-color)"
                      icon={<BsDatabaseFill />}
                    />
                  </form>
                </Box>
              )}
            </div>
          </Box>
        </Col>
      </Row>
    </Container>
  );
}

export default StudentDetails;
