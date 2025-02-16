import React, { useState, useEffect } from "react";
import { Container, Row, Col } from "react-bootstrap";
import Input from "../UI/inputs/Input";
import { levelsLoader, sectionsLoader } from "../../utils/loaders";

const OtherInformations = ({ formData, updateFormData, errors }) => {
  const [levels, setLevels] = useState([]);
  const [sections, setSections] = useState([]);
  const [filteredSections, setFilteredSections] = useState([]);

  useEffect(() => {
    const fetchLevelsAndSections = async () => {
      try {
        const levelsData = await levelsLoader();
        const sectionsData = await sectionsLoader();

        setLevels(levelsData.levels || []);
        setSections(sectionsData.sections || []);
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    };

    fetchLevelsAndSections();
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    updateFormData({ [name]: value });

    if (name === "level_id") {
      const filtered = sections.filter(
        (section) => section.level_id === parseInt(value, 10)
      );
      setFilteredSections(filtered);
    }
  };

  return (
    <Container>
      <Row>
        <Col sm={12}>
          <Input
            label="Niveau"
            name="level_id"
            type="select"
            selectOptions={levels.map((level) => ({
              value: level.id,
              label: level.name,
            }))}
            value={formData.level_id || ""}
            onChange={handleChange}
            errorMessage={errors.level_id && errors.level_id}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Classe"
            name="section_id"
            type="select"
            disabled={filteredSections.length === 0}
            selectOptions={filteredSections.map((section) => ({
              value: section.id,
              label: section.name,
            }))}
            value={formData.section_id || ""}
            onChange={handleChange}
            errorMessage={errors.section_id && errors.section_id}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="Besoin de transport"
            selectOptions={[
              { value: "1", label: "Oui" },
              { value: "0", label: "Non" },
            ]}
            name="needs_transportation"
            onChange={handleChange}
            errorMessage={
              errors.needs_transportation && errors.needs_transportation
            }
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            textarea
            label="Maladies"
            name="student_illnesses"
            value={formData.student_illnesses || ""}
            onChange={handleChange}
            errorMessage={errors.student_illnesses && errors.student_illnesses}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            label="A des problèmes d'études"
            selectOptions={[
              { value: "1", label: "Oui" },
              { value: "0", label: "Non" },
            ]}
            name="study_troubles"
            onChange={handleChange}
            errorMessage={errors.study_troubles && errors.study_troubles}
            required
          />
        </Col>
        <Col sm={12}>
          <Input
            textarea
            label="Description des problèmes d'études"
            name="study_troubles_description"
            value={formData.study_troubles_description || ""}
            onChange={handleChange}
            errorMessage={
              errors.study_troubles_description &&
              errors.study_troubles_description
            }
            required
          />
        </Col>
      </Row>
    </Container>
  );
};

export default OtherInformations;
