package com.smartstock.product;
import java.util.Optional;
import org.springframework.data.mongodb.repository.MongoRepository;
public interface ProductRepository extends MongoRepository<Product, String> { Optional<Product> findBySku(String sku); }
