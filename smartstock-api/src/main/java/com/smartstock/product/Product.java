package com.smartstock.product;

import jakarta.validation.constraints.Min;
import jakarta.validation.constraints.NotBlank;
import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.index.Indexed;
import org.springframework.data.mongodb.core.mapping.Document;

@Document("products")
public record Product(
    @Id String id,
    @Indexed(unique = true) @NotBlank String sku,
    @NotBlank String name,
    @NotBlank String category,
    String brand,
    @Min(0) double costPrice,
    @Min(0) double sellingPrice,
    @Min(0) int reorderLevel,
    ProductStatus status) {
  public Product { if (status == null) status = ProductStatus.ACTIVE; }
}
