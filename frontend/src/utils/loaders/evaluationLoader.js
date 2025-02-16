import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function updateEvaluationLoader({ params }) {
  const authToken = getAuthToken();
  try {
    const [evaluationResponse, levelsResponse, teachersResponse] =
      await Promise.all([
        axios.get(AppURL.manageEvaluation(params.id), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        }),
        axios.get(AppURL.allLevels(), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        }),
        axios.get(AppURL.allTeachers(), {
          headers: {
            Authorization: `Bearer ${authToken}`,
          },
        }),
      ]);

    const evaluationData = evaluationResponse.data;
    const levelsData = levelsResponse.data;
    const teachersData = teachersResponse.data;

    return {
      evaluation: evaluationData.evaluation,
      levels: levelsData.levels,
      teachers: teachersData.teachers,
    };
  } catch (error) {
    console.error("Error fetching levels or teachers data:", error);
    throw error;
  }
}

export async function evaluationLoader() {
  const authToken = getAuthToken();
  try {
    const [levelsResponse, teachersResponse] = await Promise.all([
      axios.get(AppURL.allLevels(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allTeachers(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const levelsData = levelsResponse.data;
    const teachersData = teachersResponse.data;

    return { levels: levelsData.levels, teachers: teachersData.teachers };
  } catch (error) {
    console.error("Error fetching levels or teachers data:", error);
    throw error;
  }
}

export async function evaluationsLoader() {
  const authToken = getAuthToken();
  try {
    const response = await axios.get(AppURL.allEvaluations(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching evaluation data:", error);
    throw error;
  }
}
