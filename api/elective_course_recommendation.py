#!/usr/bin/env python3
# uvicorn api.elective_course_recommendation:app --host 0.0.0.0 --port 8001 --reload --log-level debug
import logging
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from sentence_transformers import SentenceTransformer, util
import numpy as np

logging.basicConfig(
    level=logging.DEBUG,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[logging.StreamHandler()]
)
logger = logging.getLogger(__name__)

app = FastAPI()

# Load pre-trained model một lần khi khởi động ứng dụng
model = SentenceTransformer('all-MiniLM-L6-v2')
logger.debug("Loaded SentenceTransformer model: all-MiniLM-L6-v2")

class RecommendationRequest(BaseModel):
    preference: str
    course_descriptions: list[str]

@app.post("/recommend")
def recommend(req: RecommendationRequest):
    logger.debug("Received request: %s", req.model_dump())
    try:
        # Tính embedding cho sở thích và các mô tả môn học
        pref_embedding = model.encode([req.preference])[0]
        course_embeddings = model.encode(req.course_descriptions)
        cos_sim = util.cos_sim(pref_embedding, course_embeddings)  # matrix 1 x N
        cos_sim = np.array(cos_sim[0])  # chuyển về mảng numpy

        # Lấy top 3 chỉ số có similarity cao nhất
        top3_idx = cos_sim.argsort()[-3:][::-1]
        top3 = [{"index": int(idx), "score": float(cos_sim[idx])} for idx in top3_idx]
        logger.debug("Top3 recommendation: %s", top3)
        return {"top3": top3}
    except Exception as e:
        logger.error("Error in /recommend: %s", str(e))
        raise HTTPException(status_code=500, detail=str(e))
