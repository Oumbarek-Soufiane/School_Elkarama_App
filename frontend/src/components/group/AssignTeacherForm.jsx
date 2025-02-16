import React, { useEffect, useState, Fragment } from "react";
import { Row, Col, Table } from "react-bootstrap";
import axios from "axios";
import { BsDatabaseFill } from "react-icons/bs";
import { LiaChalkboardTeacherSolid } from "react-icons/lia";
import { FaUserGraduate } from "react-icons/fa";
import { useActionData, Form, useNavigate, Link } from "react-router-dom";
import { useDispatch } from "react-redux";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { setSuccessMessage } from "../../redux/slices/successMessageSlice";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../../utils/loaders";

function AssignTeacherForm({ method, groups }) {
  const actionData = useActionData();
  const navigate = useNavigate();
  const dispatch = useDispatch();

  const [levels, setLevels] = useState([]);
  const [selectedLevel, setSelectedLevel] = useState(null);
  const [filteredSections, setFilteredSections] = useState([]);
  const [filteredGroups, setFilteredGroups] = useState([]);
  const [teachers, setTeachers] = useState([]);
  const [selectedTeachers, setSelectedTeachers] = useState([]);

  const token = getAuthToken();

  useEffect(() => {
    const fetchTeachers = async () => {
      try {
        const response = await axios.get(AppURL.allTeachers(), {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if (response.data && Array.isArray(response.data.teachers)) {
          setTeachers(response.data.teachers);
        } else {
          console.error("Data retrieved is not as expected:", response.data);
        }
      } catch (error) {
        console.error("Error fetching teachers:", error);
      }
    };

    fetchTeachers();
  }, [token]);

  useEffect(() => {
    const allLevels = groups.map((group) => group.section.level);
    const uniqueLevels = allLevels.filter(
      (level, index, self) => index === self.findIndex((l) => l.id === level.id)
    );
    setLevels(uniqueLevels);
  }, [groups]);

  useEffect(() => {
    if (selectedLevel) {
      const sections = groups
        .filter((group) => group.section.level.id === selectedLevel.id)
        .map((group) => group.section)
        .filter(
          (section, index, self) =>
            index === self.findIndex((s) => s.id === section.id)
        );
      setFilteredSections(sections);
    } else {
      setFilteredSections([]);
      setFilteredGroups([]);
    }
  }, [selectedLevel, groups]);

  const handleSectionChange = (e) => {
    const sectionId = parseInt(e.target.value);
    const groupsForSection = groups.filter(
      (group) => group.section_id === sectionId
    );
    setFilteredGroups(groupsForSection);
  };

  const handleTeacherChange = (e) => {
    const teacherId = parseInt(e.target.value);
    if (e.target.checked) {
      setSelectedTeachers((prev) => [...prev, teacherId]);
    } else {
      setSelectedTeachers((prev) => prev.filter((id) => id !== teacherId));
    }
  };

  useEffect(() => {
    if (actionData && actionData.message) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/groups/list");
    }
  }, [actionData, navigate, dispatch]);

  const handleGroupChange = async (e) => {
    const groupId = parseInt(e.target.value);
    try {
      const response = await axios.get(
        AppURL.teachersAssignedToGroup(groupId),
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      if (response.data && Array.isArray(response.data.teacherGroups)) {
        const assignedTeacherIds = response.data.teacherGroups.map(
          (tg) => tg.teacher_id
        );
        setSelectedTeachers(assignedTeacherIds);
      } else {
        console.error("Data retrieved is not as expected:", response.data);
      }
    } catch (error) {
      console.error("Error fetching assigned teachers:", error);
    }
  };


  return (
    <Fragment>
      <Form method={method}>
        <Row className="text-center">
          <Col>
            <Link to="/admin/assign/students/groups">
              <Button
                size="small"
                text="Affecter étudiants au groupe"
                backgroundColor="var(--alkarama-primary-color)"
                textColor="var(--alkarama-white)"
                icon={<FaUserGraduate />}
              />
            </Link>
          </Col>
          <Col>
            <Link to="/admin/assign/teachers/groups">
              <Button
                size="small"
                text="Affecter professeurs au groupe"
                backgroundColor="var(--alkarama-primary-color)"
                textColor="var(--alkarama-white)"
                icon={<LiaChalkboardTeacherSolid />}
              />
            </Link>
          </Col>
        </Row>
        <Row>
          <Col sm={12} md={6} lg={4}>
            <Input
              label="Niveau"
              name="level_id"
              type="select"
              selectOptions={levels.map((level) => ({
                value: level.id,
                label: level.name,
              }))}
              onChange={(e) =>
                setSelectedLevel(
                  levels.find((level) => level.id === parseInt(e.target.value))
                )
              }
              required
            />
          </Col>
          <Col sm={12} md={6} lg={4}>
            <Input
              label="Section"
              name="section_id"
              type="select"
              selectOptions={filteredSections.map((section) => ({
                value: section.id,
                label: section.name,
              }))}
              onChange={handleSectionChange}
              required
              disabled={!selectedLevel}
            />
          </Col>
          <Col sm={12} md={6} lg={4}>
            <Input
              label="Groupe"
              name="group_id"
              type="select"
              selectOptions={filteredGroups.map((group) => ({
                value: group.id,
                label: group.name,
              }))}
              onChange={handleGroupChange}
              required
              disabled={filteredGroups.length === 0}
            />
          </Col>
        </Row>
        <Row className="mt-4">
          <Col>
            <h5>Professeurs disponibles :</h5>
            <Table striped bordered hover>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Matières enseignées</th>
                  <th>Affecter</th>
                </tr>
              </thead>
              <tbody>
                {Array.isArray(teachers) &&
                  teachers.length > 0 &&
                  teachers.map((teacher) => (
                    <tr key={teacher.id}>
                      <td>{teacher.id}</td>
                      <td>{teacher.teacher_last_name}</td>
                      <td>{teacher.teacher_first_name}</td>
                      <td>
                        {teacher.subjects.map((subject) => (
                          <span key={subject.id}>{subject.name}, </span>
                        ))}
                      </td>
                      <td>
                        <input
                          name="teachers[]"
                          type="checkbox"
                          value={teacher.id}
                          onChange={handleTeacherChange}
                          checked={selectedTeachers.includes(teacher.id)}
                          disabled={filteredGroups.length === 0}
                        />
                      </td>
                    </tr>
                  ))}
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
          disabled={
            filteredGroups.length === 0 || selectedTeachers.length === 0
          }
        />
      </Form>
    </Fragment>
  );
}

export default AssignTeacherForm;
